<?php

defined('TYPO3') or defined('TYPO3_MODE') or die('Access denied.');

call_user_func(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterSubmit'][1517255631] = \Extrameile\FormDynamicRecipient\Hooks\FormElementsOnSubmitHooks::class;
});
