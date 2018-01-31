<?php
namespace AndreasKiessling\FormDynamicRecipient\Domain\Repository;

/**
 * The repository for Recipients
 */
class RecipientRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
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
