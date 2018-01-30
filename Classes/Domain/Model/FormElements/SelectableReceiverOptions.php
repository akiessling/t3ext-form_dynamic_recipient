<?php
namespace AndreasKiessling\DynamicFormReceiver\Domain\Model\FormElements;

use AndreasKiessling\DynamicFormReceiver\Domain\Repository\ReceiverRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class SelectableReceiverOptions extends \TYPO3\CMS\Form\Domain\Model\FormElements\GenericFormElement
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function setProperty(string $key, $value)
    {
        if ($key === 'pageUid') {
            $this->setProperty('options', $this->getOptions($value));
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
        foreach ($this->getReceiversFromPid($pid) as $receiver) {
            $options[$receiver->getUid()] = $receiver->getReceiverName();
        }
        return $options;
    }

    /**
     * @param int $pid
     * @return \AndreasKiessling\DynamicFormReceiver\Domain\Model\Receiver[]
     */
    protected function getReceiversFromPid(int $pid) : array
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $receiverRepository = $objectManager->get(ReceiverRepository::class);
        return $receiverRepository->findInPid($pid);
    }
}
