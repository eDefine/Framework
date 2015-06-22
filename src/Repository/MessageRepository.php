<?php

namespace Repository;

use Edefine\Framework\ORM\AbstractRepository;
use Entity\User;

class MessageRepository extends AbstractRepository
{
    public function getAllForUser(User $user)
    {
        $queryBuilder = $this->getSelectQueryBuilder()
            ->addWhere(sprintf('recipientId = %d', $user->getId()))
            ->addOrderBy('date', 'asc');

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }

    public function getNewForUser(User $user)
    {
        $queryBuilder = $this->getSelectQueryBuilder()
            ->addWhere(sprintf('recipientId = %d', $user->getId()))
            ->addWhere('new = 1')
            ->addOrderBy('date', 'asc');

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }
}