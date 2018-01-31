<?php
namespace AndreasKiessling\FormDynamicRecipient\Domain\Model\FormElements;

use AndreasKiessling\FormDynamicRecipient\Domain\Repository\RecipientRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class SelectableRecipientOptions extends \TYPO3\CMS\Form\Domain\Model\FormElements\GenericFormElement
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function setProperty(string $key, $value)
    {
        if ($key === 'pageUid') {
            $this->setProperty('options', $this->getOptions($value));
            // automatic cache clearing with data handler, if anything in that page changes
            if ($GLOBALS['TSFE']) {
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
    protected function getOptions(int $pid) : array
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
    protected function getRecipientsFromPid(int $pid) : array
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $RecipientRepository = $objectManager->get(RecipientRepository::class);
        return $RecipientRepository->findInPid($pid);
    }
}
