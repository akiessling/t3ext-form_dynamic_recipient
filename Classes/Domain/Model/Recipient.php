<?php

declare(strict_types=1);

namespace AndreasKiessling\FormDynamicRecipient\Domain\Model;

/**
 * Recipient
 */
class Recipient extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const TABLE = 'tx_formdynamicrecipient_domain_model_recipient';

    /**
     * recipientLabel
     *
     * @var string
     */
    protected $recipientLabel = '';

    /**
     * RecipientEmail
     *
     * @var string
     */
    protected $recipientEmail = '';

    protected $isOptgroup = false;

    /**
     * This is important for rendering the option in the summary page and mail
     */
    public function __toString(): string
    {
        return $this->recipientLabel;
    }
    /**
     * Returns the recipientLabel
     *
     * @return string
     */
    public function getRecipientLabel(): string
    {
        return $this->recipientLabel;
    }

    /**
     * Sets the Recipientlabel
     *
     * @param string $recipientLabel
     * @return $this
     */
    public function setRecipientLabel(string $recipientLabel)
    {
        $this->recipientLabel = $recipientLabel;
        return $this;
    }

    /**
     * Returns the recipientEmail
     *
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->recipientEmail;
    }

    /**
     * Sets the RecipientEmail
     *
     * @param string $recipientEmail
     * @return $this
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
        return $this;
    }
    public function getIsOptgroup(): bool
    {
        return $this->isOptgroup;
    }
    public function setIsOptgroup(bool $isOptgroup)
    {
        $this->isOptgroup = $isOptgroup;
    }
}
