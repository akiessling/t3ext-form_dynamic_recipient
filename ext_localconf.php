<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'FE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterSubmit'][1517255631] = \AndreasKiessling\DynamicFormReceiver\Hooks\FormElementsOnSubmitHooks::class;
}
