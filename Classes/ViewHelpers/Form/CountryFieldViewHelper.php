<?php
namespace In2code\Powermailpits\ViewHelpers\Form;
/**
 * View helper to generate select field with empty values, preselected, etc...
 *
 * @package TYPO3
 * @subpackage Fluid
 */
class CountryFieldViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Generate Select
     *
     * @param 	array 		Options to render
     * 		option1 =>
     * 			label => Red Shoes
     * 			value => red
     * 			selected => 1
     * @param 	string 		Class
     * @param 	string 		ID
     * @return 	string		Select field
     */
    public function render($options, $class = '', $id = '') {
        // config
//		$this->registerFieldNameForFormTokenGeneration($this->prefixFieldName($this->getName()));
        $this->registerFieldNameForFormTokenGeneration($this->getName());
        $string = '';
        $options = $this->html_countryselect();
        // select
        $string .= '<select';
        if ($this->getName()) {
//			$string .= ' name="' . $this->prefixFieldName($this->getName()) . '"';
            $string .= ' name="' . $this->getName() . '"';
        }
        if ($class) {
            $string .= ' class="' . $class . '"';
        }
        if ($id) {
            $string .= ' id="' . $id . '"';
        }
        $string .= '>';

        // option
        foreach ($options as $key => $option) {
            $string .= '<option value="' . htmlspecialchars($option['value']) . '"';
            if (
                    ($option['selected'] && !$this->getValue()) || // preselect from flexform
                    ($this->getValue() && ($option['value'] == $this->getValue() || $option['label'] == $this->getValue())) // preselect from piVars
            ) {
                $string .= ' selected="selected"';
            }
            $string .= '>';
            $string .= htmlspecialchars($option['value']);
            $string .= '</option>';
        }
        $string .= '</select>';
        return $string;
    }

    /**
     * Function html_countryselect() returns select field with countries from static_info_tables
     *
     * @return    string		$content: HTML content of current field
     */
    public function html_countryselect() {
        $langValue = $GLOBALS['TSFE']->config['config']['language'];
        switch ($langValue) {
            case 'fh':
                 $langValue ="chfr";

                break;
            case 'dh':
                 $langValue ="chde";
                break;
        } 
        if (t3lib_extMgm::isLoaded('static_info_tables', 0)) { // only if static_info_tables is loaded
            $valuearray = $longvaluearray = array();
            $localfield = $whereadd = $content_item = '';
            $sort = 'cn_short_en'; // sort for a field
            // Look for another lang version (maybe static_info_tables_de or _fr)
            if ($langValue) { // if language was set in ts
                $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc(mysql_query('DESCRIBE static_countries cn_short_' .$langValue )); // check for localized version of static_info_tables
            }
            if ($row['Field']) { // if there is a localized version of static_info_tables
                $localfield = ', cn_short_' . $langValue . ' cn_short_lang'; // add to query
                //$sort = 'cn_short_lang'; // change sort
            }
         $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = TRUE;
            // Give me all needed fields from static_info_tables
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    //'uid, cn_iso_2, cn_short_local, cn_short_en' . $localfield,
                    '*' . $localfield, 'static_countries', $where_clause = '1' . $whereadd, $groupBy = '', $orderBy = $sort, $limit = ''
            );
            if ($res) { // If there is a result
                $i=0;
                while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) { // One loop for every country

                    if($row['cn_iso_3']==$GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_powermail.']['countryselect']){
                        $content[$i]['selected']=true;
                    }
                    $content[$i]['value'] = $row['cn_short_en'];
                    if(!empty($row['cn_short_'. $langValue])){
                        $content[$i]['value'] = $row['cn_short_'. $langValue];
                    }
                    $i++;
                }
            }
        }
        return $content; // return HTML
    }

}

?>