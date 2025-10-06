<?php
declare(strict_types=1);

namespace AndreasKiessling\FormDynamicRecipient\UserFuncs;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class RecordLabelUserFunc
{
    public function getRecordLabel(&$parameters): void
    {
        {
            $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']);
            if (!$record) {
                return;
            }
            $title = $record['recipient_label'];

            if ($record['is_optgroup']) {
                $title = '-- ' . $title;
                $title .= ' -- (Optgroup)';
            } else {
                $title .= ' ' . $record['recipient_email'];
            }

            $parameters['title'] = $title;
        }
    }
}