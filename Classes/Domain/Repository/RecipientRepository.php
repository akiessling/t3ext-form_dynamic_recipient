<?php

declare(strict_types=1);

namespace Extrameile\FormDynamicRecipient\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * The repository for Recipients
 */
class RecipientRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING
    ];

    public function findInPid(int $pid): array
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setStoragePageIds([$pid]);
        return $query->execute()->toArray();
    }
}
