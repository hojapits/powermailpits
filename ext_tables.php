<?php
/**
 * Include Static TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
	$_EXTKEY,
	'Configuration/TypoScript',
	'Powermail Pits'
);


/**
 * extend powermail fields tx_powermail_domain_model_fields
 */
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_powermail_domain_model_fields');
$tempColumns = array (
	'tx_powermailextended_powermail_text' => array(
		'exclude' => 1,
		'label' => 'Pre-Select Country',
		'config' => array (
			'type' => 'select',
			'size' => 10,
			'minitems' => 0,
			'maxitems' => 1,
			'itemsProcFunc' => 'powermailpits_plugin -> renderCountryList'
		),
		'displayCond' => 'FIELD:type:IN:country'
	),
	'tx_powermailextended_powermail_readonly' => array(
		'exclude' => 1,
		'label' => 'Readonly',
		'config' => array (
			'type' => 'check'
		)
	),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'tx_powermail_domain_model_fields',
	$tempColumns,
	1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tx_powermail_domain_model_fields',
	'--div--;Powermail PITS, 
	tx_powermailextended_powermail_text, 
	tx_powermailextended_powermail_readonly',
	'',
	'after:own_marker_select'
);


include_once(t3lib_extMgm::extPath($_EXTKEY).'/libs/class.powermailpits_plugin.php');
 