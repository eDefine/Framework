<?php

namespace Repository;

use Edefine\Framework\ORM\AbstractRepository;
use Entity\User;

class WeightRepository extends AbstractRepository
{
    public function getAllForUser(User $user)
    {
        $queryBuilder = $this->getSelectQueryBuilder()
            ->addWhere(sprintf('userId = %d', $user->getId()))
            ->addOrderBy('date', 'asc');

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }

    public function getMonthsToConsolidate()
    {
        $result = $this->database->query('
            SELECT userId, YEAR(date) as year, MONTH(date) as month, count(*) as number
            FROM framework.weight
            GROUP BY userId, YEAR(date), MONTH(date);
        ');

        return $result;
    }
}