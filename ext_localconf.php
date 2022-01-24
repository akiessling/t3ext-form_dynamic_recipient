<?php

defined('TYPO3') or defined('TYPO3_MODE') or die('Access denied.');

if (TYPO3_MODE === 'FE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterSubmit'][1517255631] = \Extrameile\FormDynamicRecipient\Hooks\FormElementsOnSubmitHooks::class;
}
