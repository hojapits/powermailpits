<?php

class user_title {
    var $cObj;
    var $extKey = 'powermailpits'; // Extension key
	
    function usertitle($content, $conf) {
        global $TSFE;
        // get request title from url vars
        $reqvars = t3lib_div::_GP('tx_mfcapplyonline_pi1');
        $powerMailVar = t3lib_div::_GP('tx_powermail_pi1');
        $request_title = $reqvars['request'];
        $vacancy_title = $reqvars['vacancy'];
        //addd on feb 28 2014 PITS
        $fairTitle = t3lib_div::_GP('tx_pitsuserfairs_pitsuserfairs'); //FAIR id
        if ($request_title != '') {
            $requestTitle = $this->doGetVacancyTitle($request_title);
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_requestType', 1);
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_requestId', $request_title );
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_requestId_title', $requestTitle );
            $GLOBALS['TSFE']->storeSessionData();
            return $this->cObj->stdWrap($requestTitle, $conf['title_stdWrap.']);
        }
        if ($vacancy_title != '') {
            $vacancyTitle = $this->doGetVacancyTitle($vacancy_title);
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_requestType', 2);
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_vacancyId', $vacancy_title );
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_vacancyId_title', $vacancyTitle );
            $GLOBALS['TSFE']->storeSessionData();
            
            return $this->cObj->stdWrap($vacancyTitle, $conf['title_stdWrap.']);
        } 
       if(!empty( $fairTitle )){    
            $fairLabel = $this->doGetFairTitle( $fairTitle['directRequest'] );
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_requestType', 3);
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_fairId', $fairTitle['directRequest'] );
            $GLOBALS['TSFE']->fe_user->setKey('ses', '_fairId_title', $fairLabel );
            $GLOBALS['TSFE']->storeSessionData();
            
            return $this->cObj->stdWrap( $fairLabel, $conf['title_stdWrap.'] );
            
        }

        if ( empty( $reqvars ) || empty( $fairTitle ) ) {
            $requestType = $GLOBALS["TSFE"]->fe_user->getKey("ses", "_requestType");
            switch ($requestType) {
                case 1:
                    $requestId = $GLOBALS['TSFE']->fe_user->getKey('ses', '_requestId');
                    $requestLabel = $this->doGetVacancyTitle( $requestId );
                    return $this->cObj->stdWrap( $requestLabel, $conf['title_stdWrap.'] );            
                    //return $this->cObj->stdWrap($GLOBALS['TSFE']->fe_user->getKey('ses', '_requestitem_legend'), $conf['title_stdWrap.']);
                    break;

                case 2:
                    $vacancy_title = $GLOBALS['TSFE']->fe_user->getKey('ses', '_vacancyId');
                    $vacancyTitle = $this->doGetVacancyTitle($vacancy_title);
                    return $this->cObj->stdWrap($vacancyTitle, $conf['title_stdWrap.']);
                    break;
                
                case 3:
                    $fairId = $GLOBALS['TSFE']->fe_user->getKey('ses', '_fairId');
                    $fairLabel = $this->doGetFairTitle( $fairId );
                    return $this->cObj->stdWrap( $fairLabel, $conf['title_stdWrap.'] );
                    break;
            }
        }
    }

    function doGetVacancyTitle($vacancyTitle ='') {
        //$lang = t3lib_div::_GP('L');
        /*
          if(empty($lang)){
          $lang = $GLOBALS['TSFE']->sys_language_uid;
          }
         */
        $lang = $GLOBALS['TSFE']->sys_language_uid;
        $from = 'pages';
        $whereClause = "uid=" . $vacancyTitle . " AND `hidden`=0 AND `deleted` =0";
        if ($lang != 0 && $lang != 3) {
            $from = 'pages_language_overlay';
            $whereClause = "pid=" . $vacancyTitle . " AND `sys_language_uid`=$lang AND `hidden`=0 AND `deleted` =0";
        }
        $orderByClause = '';
        $limitClause = '';
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('title', $from, $whereClause, '', $orderByClause, $limitClause
        );
        if ($result[0]['title'] != '') {
            $vacancyTitle = $result[0]['title'];
        }
        return $vacancyTitle;
    }

    function doGetFairTitle( $fairId ) {
        #$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
        $fairTitle = '';
        $lang = $GLOBALS['TSFE']->sys_language_uid;
        $whereClause = "(TPU.uid =" . $fairId . " OR TPU.l18n_parent =" . $fairId . " ) AND TPU.sys_language_uid = $lang";
        if($lang != 0 && $lang != 3){
            
            $whereClause = "(TPU.uid =" . $fairId . " OR TPU.l18n_parent =" . $fairId . " ) AND TPU.sys_language_uid = ".$lang;
            
        }
        $from = 'tx_pits_userfairs AS TPU LEFT JOIN static_countries AS SC ON TPU.country = SC.uid';
        $orderByClause = '';
        $limitClause = '';
        $langName = ( $lang == 0 || $lang == 3 ) ? 'cn_short_en' : 'cn_short_'.$GLOBALS['TSFE']->config['config']['language'];
        $selectData = 'TPU.headline,SC.cn_short_en,SC.'.$langName;
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows( $selectData, $from, $whereClause, '', $orderByClause, $limitClause );
       #echo $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
        if (!empty($result[0])) {
            $countryName = ( $result[0][$langName] != '' ) ? $result[0][$langName] : $result[0]['cn_short_en'];
            $fairTitle = $result[0]['headline'].'|'. ucwords( $countryName );
        }
        return $fairTitle;
    }

}

?>
