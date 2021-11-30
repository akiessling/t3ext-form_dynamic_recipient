<?php

declare(strict_types=1);

namespace Extrameile\FormDynamicRecipient\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * The repository for Recipients
 */
class RecipientRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING
    ];

    /**
     * @param $pid
     * @return array
     */
    public function findInPid($pid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setStoragePageIds([$pid]);
        return $query->execute()->toArray();
    }
}
