<?php
namespace AndreasKiessling\FormDynamicRecipient\Hooks;

use AndreasKiessling\FormDynamicRecipient\Domain\Model\Recipient;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;

class FormElementsOnSubmitHooks
{
    /**
     * @param \TYPO3\CMS\Form\Domain\Runtime\FormRuntime $formRuntime
     * @param \TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface $renderable
     * @param $elementValue
     * @param array $requestArguments
     * @return mixed
     * @throws \Exception
     */
    public function afterSubmit(FormRuntime $formRuntime, RenderableInterface $renderable, $elementValue, array $requestArguments = [])
    {
        /** @var \AndreasKiessling\FormDynamicRecipient\Domain\Model\FormElements\SelectableRecipientOptions $renderable */
        if ($renderable->getType() === 'FormDynamicRecipient') {
            $assignedVariable = $renderable->getProperties()['assignedVariable'] ?: 'dynamicRecipient';

            $uid = (int) $elementValue;

            if ($uid === 0 || !array_key_exists($uid, $renderable->getProperties()['options'])) {
                throw new \Exception('Invalid value for recipient detected', 1517428129);
            }


            $row = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(Recipient::TABLE)
            ->select(
                ['uid', 'recipient_label', 'recipient_email'],
                Recipient::TABLE, // from
                ['uid' => $uid] // where
            )
            ->fetch();

            // should not happen, since the TCA field is evaluated to email
            if (!GeneralUtility::validEmail($row['recipient_email'])) {
                throw new \Exception('Invalid email address for recipient detected', 1517428129);
            }

            $formRuntime->getFormState()->setFormValue($assignedVariable . '.email', $row['recipient_email']);
            $formRuntime->getFormState()->setFormValue($assignedVariable . '.name', $row['recipient_label']);
        }

        return $elementValue;
    }
}
