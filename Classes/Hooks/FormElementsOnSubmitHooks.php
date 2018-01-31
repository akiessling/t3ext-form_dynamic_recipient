<?php
namespace AndreasKiessling\FormDynamicRecipient\Hooks;

use AndreasKiessling\FormDynamicRecipient\Domain\Model\Recipient;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;

class FormElementsOnSubmitHooks
{
    public function afterSubmit(FormRuntime $formRuntime, RenderableInterface $renderable, $elementValue, array $requestArguments = [])
    {
        /** @var \AndreasKiessling\DynamicFormRecipient\Domain\Model\FormElements\SelectableRecipientOptions $renderable */
        if ($renderable->getType() === 'FormDynamicRecipient') {

            $assignedVariable = $renderable->getProperties()['assignedVariable'] ?: 'dynamicRecipient';

            $uid = (int) $elementValue;
            if ($uid > 0) {
                $row = GeneralUtility::makeInstance(ConnectionPool::class)
                    ->getConnectionForTable(Recipient::TABLE)
                    ->select(
                        ['uid', 'recipient_label', 'recipient_email'],
                        Recipient::TABLE, // from
                        [ 'uid' => $uid ] // where
                    )
                    ->fetch();

                if (GeneralUtility::validEmail($row['recipient_email'])) {
                    $formRuntime->getFormState()->setFormValue($assignedVariable . '.email', $row['recipient_email']);
                    $formRuntime->getFormState()->setFormValue($assignedVariable . '.name', $row['recipient_label']);
                }
            }
        }

        return $elementValue;
    }
}
