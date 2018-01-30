<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dynamicformreceiver_domain_model_receiver', 'EXT:dynamic_form_receiver/Resources/Private/Language/locallang_csh_tx_dynamicformreceiver_domain_model_receiver.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dynamicformreceiver_domain_model_receiver');
    }
);
