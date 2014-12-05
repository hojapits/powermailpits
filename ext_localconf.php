<?php
# enable SignalSlot
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\SignalSlot\Dispatcher');
/*
* Signal Class Name - \In2code\Powermail\Controller\FormController
* Signal Name 		- createActionBeforeRenderView
* Description		- Slot is called before the answered are stored and the mails are sent
*/
$signalSlotDispatcher->connect(
	'In2code\Powermail\Controller\FormController',
	'createActionBeforeRenderView',
	'In2code\Powermailpits\Controller\FormController',
	'manipulateMailObjectOnCreate',
	FALSE
);
/*
* Signal Class Name - \In2code\Powermail\Controller\FormController
* Signal Name 		- formActionBeforeRenderView
* Description		- Slot is called before the form is rendered
*/
$signalSlotDispatcher->connect(
	'In2code\Powermail\Controller\FormController',
	'formActionBeforeRenderView',
	'In2code\Powermailpits\Controller\FormController',
	'signalTest',
	FALSE
);
/*
* Signal Class Name - \In2code\Powermail\Utility\SendMail
* Signal Name 		- sendTemplateEmailBeforeSend
* Description		- Change the emails before sending
*/
$signalSlotDispatcher->connect(
	'\In2code\Powermail\Utility\SendMail',
	'sendTemplateEmailBeforeSend',
	'In2code\Powermailpits\Utility\SendMail',
	'manipulateMailContent',
	FALSE
); 

/*
* Signal Class Name - \In2code\Powermail\Utility\SendMail
* Signal Name 		- createEmailBodyBeforeRender
* Description		- Change the body of the mails
*/
$signalSlotDispatcher->connect(
	'\In2code\Powermail\Utility\SendMail',
	'createEmailBodyBeforeRender',
	'In2code\Powermailpits\Controller\FormController',
	'signalTest2',
	FALSE
); 