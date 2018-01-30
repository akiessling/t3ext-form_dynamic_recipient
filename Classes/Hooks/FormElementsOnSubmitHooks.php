<?php
namespace AndreasKiessling\DynamicFormReceiver\Hooks;

use AndreasKiessling\DynamicFormReceiver\Domain\Model\Receiver;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;

class FormElementsOnSubmitHooks
{
    public function afterSubmit(FormRuntime $formRuntime, RenderableInterface $renderable, $elementValue, array $requestArguments = [])
    {
        if ($renderable->getType() === 'DynamicFormReceiver') {
            $uid = (int) $elementValue;
            if ($uid > 0) {
                $row = GeneralUtility::makeInstance(ConnectionPool::class)
                    ->getConnectionForTable(Receiver::TABLE)
                    ->select(
                        ['uid', 'receiver_name', 'receiver_email'],
                        Receiver::TABLE, // from
                        [ 'uid' => $uid ] // where
                    )
                    ->fetch();

                if (GeneralUtility::validEmail($row['receiver_email'])) {
                    $formRuntime->getFormState()->setFormValue('dynamicReceiver.email', $row['receiver_email']);
                    $formRuntime->getFormState()->setFormValue('dynamicReceiver.name', $row['receiver_name']);
                }
            }
        }

        return $elementValue;
    }
}
