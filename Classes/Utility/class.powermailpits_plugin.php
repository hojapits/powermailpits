<?php
#namespace In2code\Powermailpits\Utility;

class powermailpits_plugin extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {	
	

	public function getCountries( ) {
		$selectFields		=	" cn_iso_3 , cn_short_en";
		$from_table 		= 	'static_countries';
		$where_clause 		= 	NULL;
		$groupBy 			=	NULL;
		$orderBy 			= 	'cn_short_en';
		$countries  		= 	$GLOBALS['TYPO3_DB']->exec_SELECTgetRows( $selectFields, $from_table, $where_clause, $groupBy, $orderBy );
		$countriesArray		=	array();
		foreach ($countries as $key => $value) {
			$countriesArray[$value['cn_iso_3']] = $value['cn_short_en']  ;
		}
		return $countriesArray;
	}

	public function renderCountryList( $params ){
		$countries 			= 	$this->getCountries();
		$finalArray			=	( !is_array( $countries ) )? ( $this -> getCountryList() ) : $countries;
		foreach ($finalArray as $key => $value) {
			$params['items'][]	=	array( $value , $key );
		}
	}

	public function getCountryList(){
		$countries = array(
			'AFG' => 'Afghanistan',
			'ALA' => 'Åland',
			'ALB' => 'Albania',
			'DZA' => 'Algeria',
			'ASM' => 'American Samoa',
			'AND' => 'Andorra',
			'AGO' => 'Angola',
			'AIA' => 'Anguilla',
			'ATA' => 'Antarctica',
			'ATG' => 'Antigua and Barbuda',
			'ARG' => 'Argentina',
			'ARM' => 'Armenia',
			'ABW' => 'Aruba',
			'AUS' => 'Australia',
			'AUT' => 'Austria',
			'AZE' => 'Azerbaijan',
			'BHR' => 'Bahrain',
			'BGD' => 'Bangladesh',
			'BRB' => 'Barbados',
			'BLR' => 'Belarus',
			'BEL' => 'Belgium',
			'BLZ' => 'Belize',
			'BEN' => 'Benin',
			'BMU' => 'Bermuda',
			'BTN' => 'Bhutan',
			'BOL' => 'Bolivia',
			'BES' => 'Bonaire, Sint Eustatius and Saba',
			'BIH' => 'Bosnia and Herzegovina',
			'BWA' => 'Botswana',
			'BVT' => 'Bouvet Island',
			'BRA' => 'Brazil',
			'IOT' => 'British Indian Ocean Territory',
			'VGB' => 'British Virgin Islands',
			'BRN' => 'Brunei',
			'BGR' => 'Bulgaria',
			'BFA' => 'Burkina Faso',
			'BDI' => 'Burundi',
			'KHM' => 'Cambodia',
			'CMR' => 'Cameroon',
			'CAN' => 'Canada',
			'CPV' => 'Cape Verde',
			'CYM' => 'Cayman Islands',
			'CAF' => 'Central African Republic',
			'TCD' => 'Chad',
			'CHL' => 'Chile',
			'CHN' => 'China',
			'CXR' => 'Christmas Island',
			'CCK' => 'Cocos (Keeling) Islands',
			'COL' => 'Colombia',
			'COM' => 'Comoros',
			'COD' => 'Congo',
			'COG' => 'Congo-Brazzaville',
			'COK' => 'Cook Islands',
			'CRI' => 'Costa Rica',
			'CIV' => 'Côte d’Ivoire',
			'HRV' => 'Croatia',
			'CUB' => 'Cuba',
			'CUW' => 'Curaçao',
			'CYP' => 'Cyprus',
			'CZE' => 'Czech Republic',
			'DNK' => 'Denmark',
			'DJI' => 'Djibouti',
			'DMA' => 'Dominica',
			'DOM' => 'Dominican Republic',
			'ECU' => 'Ecuador',
			'EGY' => 'Egypt',
			'SLV' => 'El Salvador',
			'GNQ' => 'Equatorial Guinea',
			'ERI' => 'Eritrea',
			'EST' => 'Estonia',
			'ETH' => 'Ethiopia',
			'FLK' => 'Falkland Islands',
			'FRO' => 'Faroes',
			'FJI' => 'Fiji',
			'FIN' => 'Finland',
			'FRA' => 'France',
			'GUF' => 'French Guiana',
			'PYF' => 'French Polynesia',
			'ATF' => 'French Southern Territories',
			'GAB' => 'Gabon',
			'GMB' => 'Gambia',
			'GEO' => 'Georgia',
			'DEU' => 'Germany',
			'GHA' => 'Ghana',
			'GIB' => 'Gibraltar',
			'GRC' => 'Greece',
			'GRL' => 'Greenland',
			'GRD' => 'Grenada',
			'GLP' => 'Guadeloupe',
			'GUM' => 'Guam',
			'GTM' => 'Guatemala',
			'GGY' => 'Guernsey',
			'GIN' => 'Guinea',
			'GNB' => 'Guinea-Bissau',
			'GUY' => 'Guyana',
			'HTI' => 'Haiti',
			'HMD' => 'Heard Island and McDonald Islands',
			'HND' => 'Honduras',
			'HKG' => 'Hong Kong SAR of China',
			'HUN' => 'Hungary',
			'ISL' => 'Iceland',
			'IND' => 'India',
			'IDN' => 'Indonesia',
			'IRN' => 'Iran',
			'IRQ' => 'Iraq',
			'IRL' => 'Ireland',
			'IMN' => 'Isle of Man',
			'ISR' => 'Israel',
			'ITA' => 'Italy',
			'JAM' => 'Jamaica',
			'JPN' => 'Japan',
			'JEY' => 'Jersey',
			'JOR' => 'Jordan',
			'KAZ' => 'Kazakhstan',
			'KEN' => 'Kenya',
			'KIR' => 'Kiribati',
			'KWT' => 'Kuwait',
			'KGZ' => 'Kyrgyzstan',
			'LAO' => 'Laos',
			'LVA' => 'Latvia',
			'LBN' => 'Lebanon',
			'LSO' => 'Lesotho',
			'LBR' => 'Liberia',
			'LBY' => 'Libya',
			'LIE' => 'Liechtenstein',
			'LTU' => 'Lithuania',
			'LUX' => 'Luxembourg',
			'MAC' => 'Macao SAR of China',
			'MKD' => 'Macedonia',
			'MDG' => 'Madagascar',
			'MWI' => 'Malawi',
			'MYS' => 'Malaysia',
			'MDV' => 'Maldives',
			'MLI' => 'Mali',
			'MLT' => 'Malta',
			'MHL' => 'Marshall Islands',
			'MTQ' => 'Martinique',
			'MRT' => 'Mauritania',
			'MUS' => 'Mauritius',
			'MYT' => 'Mayotte',
			'MEX' => 'Mexico',
			'FSM' => 'Micronesia',
			'MDA' => 'Moldova',
			'MCO' => 'Monaco',
			'MNG' => 'Mongolia',
			'MNE' => 'Montenegro',
			'MSR' => 'Montserrat',
			'MAR' => 'Morocco',
			'MOZ' => 'Mozambique',
			'MMR' => 'Myanmar',
			'NAM' => 'Namibia',
			'NRU' => 'Nauru',
			'NPL' => 'Nepal',
			'NLD' => 'Netherlands',
			'NCL' => 'New Caledonia',
			'NZL' => 'New Zealand',
			'NIC' => 'Nicaragua',
			'NER' => 'Niger',
			'NGA' => 'Nigeria',
			'NIU' => 'Niue',
			'NFK' => 'Norfolk Island',
			'PRK' => 'North Korea',
			'MNP' => 'Northern Marianas',
			'NOR' => 'Norway',
			'OMN' => 'Oman',
			'PAK' => 'Pakistan',
			'PLW' => 'Palau',
			'PSE' => 'Palestine',
			'PAN' => 'Panama',
			'PNG' => 'Papua New Guinea',
			'PRY' => 'Paraguay',
			'PER' => 'Peru',
			'PHL' => 'Philippines',
			'PCN' => 'Pitcairn Islands',
			'POL' => 'Poland',
			'PRT' => 'Portugal',
			'PRI' => 'Puerto Rico',
			'QAT' => 'Qatar',
			'REU' => 'Reunion',
			'ROU' => 'Romania',
			'RUS' => 'Russia',
			'RWA' => 'Rwanda',
			'BLM' => 'Saint Barthélemy',
			'SHN' => 'Saint Helena, Ascension and Tristan da Cunha',
			'KNA' => 'Saint Kitts and Nevis',
			'LCA' => 'Saint Lucia',
			'MAF' => 'Saint Martin',
			'SPM' => 'Saint Pierre and Miquelon',
			'VCT' => 'Saint Vincent and the Grenadines',
			'WSM' => 'Samoa',
			'SMR' => 'San Marino',
			'STP' => 'São Tomé e Príncipe',
			'SAU' => 'Saudi Arabia',
			'SEN' => 'Senegal',
			'SRB' => 'Serbia',
			'SYC' => 'Seychelles',
			'SLE' => 'Sierra Leone',
			'SGP' => 'Singapore',
			'SXM' => 'Sint Maarten',
			'SVK' => 'Slovakia',
			'SVN' => 'Slovenia',
			'SLB' => 'Solomon Islands',
			'SOM' => 'Somalia',
			'ZAF' => 'South Africa',
			'SGS' => 'South Georgia and the South Sandwich Islands',
			'KOR' => 'South Korea',
			'SSD' => 'South Sudan',
			'ESP' => 'Spain',
			'LKA' => 'Sri Lanka',
			'SDN' => 'Sudan',
			'SUR' => 'Suriname',
			'SJM' => 'Svalbard',
			'SWZ' => 'Swaziland',
			'SWE' => 'Sweden',
			'CHE' => 'Switzerland',
			'SYR' => 'Syria',
			'TWN' => 'Taiwan',
			'TJK' => 'Tajikistan',
			'TZA' => 'Tanzania',
			'THA' => 'Thailand',
			'BHS' => 'The Bahamas',
			'TLS' => 'Timor-Leste',
			'TGO' => 'Togo',
			'TKL' => 'Tokelau',
			'TON' => 'Tonga',
			'TTO' => 'Trinidad and Tobago',
			'TUN' => 'Tunisia',
			'TUR' => 'Turkey',
			'TKM' => 'Turkmenistan',
			'TCA' => 'Turks and Caicos Islands',
			'TUV' => 'Tuvalu',
			'UGA' => 'Uganda',
			'UKR' => 'Ukraine',
			'ARE' => 'United Arab Emirates',
			'GBR' => 'United Kingdom',
			'USA' => 'United States',
			'UMI' => 'United States Minor Outlying Islands',
			'URY' => 'Uruguay',
			'VIR' => 'US Virgin Islands',
			'UZB' => 'Uzbekistan',
			'VUT' => 'Vanuatu',
			'VAT' => 'Vatican City',
			'VEN' => 'Venezuela',
			'VNM' => 'Vietnam',
			'WLF' => 'Wallis and Futuna',
			'ESH' => 'Western Sahara',
			'YEM' => 'Yemen',
			'ZMB' => 'Zambia',
			'ZWE' => 'Zimbabwe'
		);
		return $countries;
	}
}
?>