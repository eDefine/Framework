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
                $queryBuilder->addWhere(sprintf('%s = "%s"', $field, $value));
            } else {
                $queryBuilder->addWhere($value);
            }
        }

        $query = $queryBuilder->getQuery();

        return $query->execute();
    }

    /**
     * @param $id
     * @return AbstractEntity
     * @throws \RuntimeException
     */
    public function findOneById($id)
    {
        $results = $this->findAll(['id' => $id]);

        if (count($results) == 0) {
            throw new \RuntimeException(sprintf('Entity with id %d was not found', $id));
        }

        return $results[0];
    }

    /**
     * @return SelectQueryBuilder
     */
    protected function getSelectQueryBuilder()
    {
        return new SelectQueryBuilder($this->entityClass, $this->database);
    }
}