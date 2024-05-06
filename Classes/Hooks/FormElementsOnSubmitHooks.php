<?php

declare(strict_types=1);

namespace Extrameile\FormDynamicRecipient\Hooks;

use Extrameile\FormDynamicRecipient\Domain\Model\Recipient;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Validation\Error;
use TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;
use TYPO3\CMS\Form\Service\TranslationService;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

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
        /** @var \Extrameile\FormDynamicRecipient\Domain\Model\FormElements\SelectableRecipientOptions $renderable */
        if ($renderable->getType() === 'FormDynamicRecipient') {
            $assignedVariable = $renderable->getProperties()['assignedVariable'] ?: 'dynamicRecipient';

            $uid = (int) $elementValue;

            if ($uid > 0 && array_key_exists($uid, $renderable->getProperties()['options'])) {
                $recipient = $this->getRecipient($uid);
                
                // should not happen, since the TCA field is evaluated to email
                if (!\is_array($recipient) || !GeneralUtility::validEmail($recipient['recipient_email'])) {
                    throw new \Exception('Invalid email address for recipient detected', 1517428129);
                }
                
                $formRuntime->getFormState()->setFormValue($assignedVariable . '.email', $recipient['recipient_email']);
                $formRuntime->getFormState()->setFormValue($assignedVariable . '.label', $recipient['recipient_label']);
                // set also name as an alias for label since this is the usual name for the recipient property
                $formRuntime->getFormState()->setFormValue($assignedVariable . '.name', $recipient['recipient_label']);
            } elseif ($uid > 0 && !array_key_exists($uid, $renderable->getProperties()['options'])) {
                $processingRule = $renderable->getRootForm()->getProcessingRule($renderable->getIdentifier());
                $processingRule->getProcessingMessages()->addError(
                    GeneralUtility::makeInstance(
                        Error::class,
                        GeneralUtility::makeInstance(TranslationService::class)->translate('validation.error.1517428129', null, 'EXT:form_dynamic_recipient/Resources/Private/Language/locallang.xlf'),
                        1517428129
                    )
                );
            }
        }

        return $elementValue;
    }

    /**
     * @param $uid
     * @return mixed
     * @throws \UnexpectedValueException
     */
    private function getRecipient($uid)
    {
        $row = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(Recipient::TABLE)
            ->select(
                ['*'],
                Recipient::TABLE, // from
                ['uid' => $uid], // where
                [], // group
                [], // order
                1   // limit
            )
            ->fetchAssociative();

        if ($row) {
            $this->getTsfe()->sys_page->versionOL(Recipient::TABLE, $row, true);

            // Language overlay:
            $languageAspect = GeneralUtility::makeInstance(Context::class)->getAspect('language');
            if (is_array($row) && $languageAspect->getContentId() > 0) {
                $row = $this->getTsfe()->sys_page->getLanguageOverlay(
                    Recipient::TABLE,
                    $row
                );
            }
        }

        return $row;
    }

    private function getTsfe(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
