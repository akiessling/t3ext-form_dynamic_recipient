<?php
namespace AndreasKiessling\DynamicFormReceiver\Domain\Model;

/**
 * Receiver
 */
class Receiver extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    const TABLE = 'tx_dynamicformreceiver_domain_model_receiver';

    /**
     * receiverName
     *
     * @var string
     */
    protected $receiverName = '';

    /**
     * receiverEmail
     *
     * @var string
     */
    protected $receiverEmail = '';

    /**
     * Returns the receiverName
     *
     * @return string $receiverName
     */
    public function getReceiverName()
    {
        return $this->receiverName;
    }

    /**
     * Sets the receiverName
     *
     * @param string $receiverName
     * @return void
     */
    public function setReceiverName($receiverName)
    {
        $this->receiverName = $receiverName;
    }

    /**
     * Returns the receiverEmail
     *
     * @return string $receiverEmail
     */
    public function getReceiverEmail()
    {
        return $this->receiverEmail;
    }

    /**
     * Sets the receiverEmail
     *
     * @param string $receiverEmail
     * @return void
     */
    public function setReceiverEmail($receiverEmail)
    {
        $this->receiverEmail = $receiverEmail;
    }
}
