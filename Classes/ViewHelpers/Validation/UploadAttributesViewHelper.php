<?php
namespace In2code\Powermailpits\ViewHelpers\Validation;

use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface,
	\TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Array for multiple upload
 *
 * @package TYPO3
 * @subpackage Fluid
 * @version
 */
class UploadAttributesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * Configuration
	 */
	protected $settings = array();

	/**
	 * Array for multiple upload
	 *
	 * @param \In2code\Powermail\Domain\Model\Field $field
	 * @param \array $additionalAttributes To add further attributes
	 * @return array
	 */
	public function render(\In2code\Powermail\Domain\Model\Field $field, $additionalAttributes = array()) {
		if ($field->getMultiselectForField()) {
			$additionalAttributes['multiple'] = 'multiple';
		}
		if (!empty($this->settings['misc']['file']['extension'])) {
			$additionalAttributes['accept'] = $this->getDottedListOfExtensions(
				$this->settings['misc']['file']['extension']
			);
		}
		return $additionalAttributes;
	}

	/**
	 * Get extensions with dot as prefix
	 *      before: jpg,png,gif
	 *      after: .jpg,.png,.gif
	 *
	 * @param string $extensionList
	 * @return string
	 */
	protected function getDottedListOfExtensions($extensionList) {
		$extensions = GeneralUtility::trimExplode(',', $extensionList, TRUE);
		return '.' . implode(',.', $extensions);
	}

	/**
	 * Init
	 *
	 * @return void
	 */
	public function initialize() {
		$typoScriptSetup = $this->configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		if (!empty($typoScriptSetup['plugin.']['tx_powermail.']['settings.']['setup.'])) {
			$this->settings = \TYPO3\CMS\Core\Utility\GeneralUtility::removeDotsFromTS(
				$typoScriptSetup['plugin.']['tx_powermail.']['settings.']['setup.']
			);
		}
	}
}