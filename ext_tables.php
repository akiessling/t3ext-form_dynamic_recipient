<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_formdynamicrecipient_domain_model_recipient', 'EXT:form_dynamic_recipient/Resources/Private/Language/locallang_csh_tx_formdynamicrecipient_domain_model_recipient.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_formdynamicrecipient_domain_model_recipient');
    }
);
