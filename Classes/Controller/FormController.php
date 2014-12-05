<?php
namespace In2code\Powermailpits\Controller;

/**
 * Using a Slot to call a Powermail Signal
 *
 * Class FormControllerExtended
 * @package In2code\Powermailpits\Controller
 */
class FormController {

	/**
	 * @param \In2code\Powermail\Domain\Model\Mail $mail
	 * @param string $hash
	 * @param \In2code\Powermail\Controller\FormController $pObj
	 */
	 
	
	public function manipulateMailObjectOnCreate($mail, $hash, $pObj) {
		echo 'test';exit;
		foreach ($mail->getAnswers() as $answer) {
			if ($answer->getValue() === 'alex') {
				$answer->setValue('alexander');
			}
		}
	}
	
	public function signalTest($mail, $arguments) {
	    echo 'Inside Befor Slot';
	    $reqDocs 	= $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_cart');
		$reqSession = $reqVars; 
	}	

	public function signalTest2($mail, $arguments) {
	    echo 'Inside Befor Slot';exit;
	    $reqDocs 	= $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_cart');
		$reqSession = $reqVars; 
	}	

	
}