<?php

namespace Repository;

use Edefine\Framework\ORM\AbstractRepository;
use Entity\User;

class TransactionRepository extends AbstractRepository
{
    const PER_PAGE = 10;

    public function getAllForUser(User $user, $sort, $page = 1)
    {
        $queryBuilder = $this->getSelectQueryBuilder()
            ->addWhere(sprintf('userId = %d', $user->getId()))
            ->addOrderBy($sort, 'asc')
            ->setLimit(self::PER_PAGE);

        if ($page > 1) {
            $queryBuilder->setOffset(($page - 1) * self::PER_PAGE);
        }

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }
}