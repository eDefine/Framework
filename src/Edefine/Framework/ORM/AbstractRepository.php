<?php

namespace Edefine\Framework\ORM;

use Edefine\Framework\Database\Connection;
use Edefine\Framework\Entity\AbstractEntity;

/**
 * Class AbstractRepository
 * @package Edefine\Framework\ORM
 */
abstract class AbstractRepository
{
    protected $database;
    private $entityClass;

    /**
     * @param $entityClass
     * @param Connection $connection
     */
    public function __construct($entityClass, Connection $connection)
    {
        $this->entityClass = $entityClass;
        $this->database = $connection;
    }

    /**
     * @param array $params
     * @return AbstractEntity[]
     * @throws \Edefine\Framework\Database\DatabaseException
     */
    public function findAll(array $params = [])
    {
        $queryBuilder = $this->getSelectQueryBuilder();

        foreach ($params as $field => $value) {
            if (is_string($field)) {
                $queryBuilder->addWhere(sprintf('`%s` = "%s"', $field, addslashes($value)));
            } else {
                $queryBuilder->addWhere($value);
            }
        }

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }

    /**
     * @param array $params
     * @return AbstractEntity
     * @throws \Exception
     */
    public function findOne(array $params = [])
    {
        $results = $this->findAll($params);

        $resultsCount = count($results);
        if ($resultsCount != 1) {
            throw new \Exception(sprintf('findOne expects one result, but %d was returned', $resultsCount));
        }

        return $results[0];
    }

    /**
     * @param $id
     * @return AbstractEntity
     * @throws \Exception
     */
    public function findOneById($id)
    {
        return $this->findOne(['id' => $id]);
    }

    /**
     * @return SelectQueryBuilder
     */
    protected function getSelectQueryBuilder()
    {
        return new SelectQueryBuilder($this->entityClass, $this->database);
    }
}