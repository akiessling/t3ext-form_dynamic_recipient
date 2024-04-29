<?php

declare(strict_types=1);

namespace Extrameile\FormDynamicRecipient\Domain\Model\FormElements;

use Extrameile\FormDynamicRecipient\Domain\Repository\RecipientRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SelectableRecipientOptions extends \TYPO3\CMS\Form\Domain\Model\FormElements\GenericFormElement
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function setProperty(string $key, $value)
    {

        if ($key === 'pageUid') {
            $value = (int) $value;
            // use uid of current page if pageUid is not set
            if ($value === 0) {
                $pageArguments = $GLOBALS['TYPO3_REQUEST']->getAttribute('routing');
                $value = $pageArguments->getPageId();
            }
            $this->setProperty('options', $this->getOptions($value));
            // automatic cache clearing with data handler, if anything in that page changes
            if ($GLOBALS['TSFE'] instanceof \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController) {
                $GLOBALS['TSFE']->addCacheTags(['pageId_' . $value]);
            }
            return;
        }

        parent::setProperty($key, $value);
    }

    /**
     * @param int $pid
     * @return array
     */
    protected function getOptions(int $pid): array
    {
        $options = [];
        foreach ($this->getRecipientsFromPid($pid) as $recipient) {
            $options[$recipient->getUid()] = $recipient->getRecipientLabel();
        }
        return $options;
    }

    /**
     * @param int $pid
     * @return \Extrameile\FormDynamicRecipient\Domain\Model\Recipient[]
     */
    protected function getRecipientsFromPid(int $pid): array
    {
        $RecipientRepository = GeneralUtility::makeInstance(RecipientRepository::class);
        return $RecipientRepository->findInPid($pid);
    }
}
