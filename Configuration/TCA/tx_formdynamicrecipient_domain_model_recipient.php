<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:form_dynamic_recipient/Resources/Private/Language/locallang_db.xlf:tx_formdynamicrecipient_domain_model_recipient',
        'label' => 'recipient_label',
        'label_alt' => 'recipient_email',
        'label_alt_force' => true,
        'label_userFunc' => \AndreasKiessling\FormDynamicRecipient\UserFuncs\RecordLabelUserFunc::class . '->getRecordLabel',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'recipient_label,recipient_email',
        'iconfile' => 'EXT:form_dynamic_recipient/Resources/Public/Icons/Recipient.svg',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, recipient_label, recipient_email, is_optgroup,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'default' => 0,
                'foreign_table' => 'tx_formdynamicrecipient_domain_model_recipient',
                'foreign_table_where' => 'AND tx_formdynamicrecipient_domain_model_recipient.pid=###CURRENT_PID### AND tx_formdynamicrecipient_domain_model_recipient.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        'value' => 1,
                        'label' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled',
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'size' => 13,
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'recipient_label' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_dynamic_recipient/Resources/Private/Language/locallang_db.xlf:tx_formdynamicrecipient_domain_model_recipient.recipient_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'recipient_email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_dynamic_recipient/Resources/Private/Language/locallang_db.xlf:tx_formdynamicrecipient_domain_model_recipient.recipient_email',
            'displayCond' => 'FIELD:is_optgroup:!=:1',
            'config' => [
                'type' => 'email',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'is_optgroup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:form_dynamic_recipient/Resources/Private/Language/locallang_db.xlf:tx_formdynamicrecipient_domain_model_recipient.is_optgroup',
            'description' => 'LLL:EXT:form_dynamic_recipient/Resources/Private/Language/locallang_db.xlf:tx_formdynamicrecipient_domain_model_recipient.is_optgroup.description',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
    ],
];
