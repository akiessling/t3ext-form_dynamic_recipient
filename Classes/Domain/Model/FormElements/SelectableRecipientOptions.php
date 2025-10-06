<?php

declare(strict_types=1);

namespace AndreasKiessling\FormDynamicRecipient\Domain\Model\FormElements;

use AndreasKiessling\FormDynamicRecipient\Domain\Repository\RecipientRepository;
use TYPO3\CMS\Core\Cache\CacheTag;
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
                $pageArguments = $this->getRequest()->getAttribute('routing');
                $value = $pageArguments->getPageId();
            } else {
                // automatic cache clearing with data handler, if anything in that page changes
                $cacheDataCollector = $this->getRequest()->getAttribute('frontend.cache.collector');
                $cacheDataCollector->addCacheTags(new CacheTag('pageId_' . $value));
            }
            $this->setProperty('options', $this->getOptions($value));

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
     * @return \AndreasKiessling\FormDynamicRecipient\Domain\Model\Recipient[]
     */
    protected function getRecipientsFromPid(int $pid): array
    {
        $RecipientRepository = GeneralUtility::makeInstance(RecipientRepository::class);
        return $RecipientRepository->findInPid($pid);
    }
}
