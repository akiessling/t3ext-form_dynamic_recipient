<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied.');

call_user_func(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterSubmit'][1517255631] = \AndreasKiessling\FormDynamicRecipient\Hooks\FormElementsOnSubmitHooks::class;

    ExtensionManagementUtility::addTypoScriptSetup('
module.tx_form {
    settings {
        yamlConfigurations {
            1517255631 = EXT:form_dynamic_recipient/Configuration/Yaml/FormSetup.yaml
        }
    }
}
');
});
