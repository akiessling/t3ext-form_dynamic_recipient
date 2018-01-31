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
        if ($renderable->getType() === 'FormDynamicRecipient') {
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
                    $formRuntime->getFormState()->setFormValue('dynamicRecipient.email', $row['recipient_email']);
                    $formRuntime->getFormState()->setFormValue('dynamicRecipient.name', $row['recipient_label']);
                }
            }
        }

        return $elementValue;
    }
}
