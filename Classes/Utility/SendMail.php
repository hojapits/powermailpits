<?php
namespace In2code\Powermailpits\Utility;

/**
 * Using a Slot to call a Powermail Signal
 *
 * Class SendMailExtended 
 * @package In2code\Powermailpits\Utility
 */
class SendMail {
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * mailRepository
	 *
	 * @var \In2code\Powermail\Domain\Repository\MailRepository
	 * @inject
	 */
	protected $mailRepository;

	/**
	 * @var \In2code\Powermail\Utility\Div
	 * @inject
	 */
	protected $div;

	/**
	 * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
	 * @inject
	 */
	protected $signalSlotDispatcher;

	/**
	 * This is the main-function for sending Mails
	 *
	 * @param array $email Array with all needed mail information
	 * 		$email['receiverName'] = 'Name';
	 * 		$email['receiverEmail'] = 'receiver@mail.com';
	 * 		$email['senderName'] = 'Name';
	 * 		$email['senderEmail'] = 'sender@mail.com';
	 * 		$email['subject'] = 'Subject line';
	 * 		$email['template'] = 'PathToTemplate/';
	 * 		$email['rteBody'] = 'This is the <b>content</b> of the RTE';
	 * 		$email['format'] = 'both'; // or plain or html
	 * @param \In2code\Powermail\Domain\Model\Mail &$mail
	 * @param array $settings TypoScript Settings
	 * @param string $type Email to "sender" or "receiver"
	 * @return bool Mail successfully sent
	 */

	public function manipulateMailContent( $message, $email, $mail, $settings, $type ){
		echo 'signal called';
		$arguments = 	array(
							'message' => $message,
							'email'   => $email,
							'mail'	  => $mail,
							'settings'=> $settings,
							'type'	  => $type		
						);
		mail('hoja.ma@pitsolutions.com', 'From Signal', 'message');
		echo '<pre>'; print_r( $arguments ); exit;
	}

	public function changeBody(){
		echo 'success';
	}
}
?>