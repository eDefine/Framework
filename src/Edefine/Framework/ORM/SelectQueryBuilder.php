<?php

namespace Edefine\Framework\ORM;

use Edefine\Framework\Database\Connection;
use Edefine\Framework\Entity\AbstractEntity;

/**
 * Class SelectQueryBuilder
 * @package Edefine\Framework\ORM
 */
class SelectQueryBuilder
{
    private $entityClass;
    private $database;
    private $whereParts = [];
    private $orderParts = [];
    private $limit;
    private $offset;

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
     * @return Query
     */
    public function getQuery()
    {
        $query = sprintf('SELECT * FROM %s', $this->getTableName());

        if ($this->whereParts) {
            $query .= ' WHERE ' . implode(' AND ', $this->whereParts);
        }

        if ($this->orderParts) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderParts);
        }

        if ($this->limit) {
            $query .= ' LIMIT ' . $this->limit;
        }

        if ($this->offset) {
            $query .= ' OFFSET ' . $this->offset;
        }

        return new Query($this->entityClass, $this->database, $query);
    }

    /**
     * @param string $where
     * @return $this
     */
    public function addWhere($where)
    {
        $this->whereParts[] = $where;

        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @return $this
     */
    public function addOrderBy($field, $order)
    {
        $this->orderParts[] = sprintf('%s %s', $field, $order);

        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return string
     */
    private function getTableName()
    {
        /** @var AbstractEntity $entity */
        $entity = new $this->entityClass;

        return $entity->getTableName();
    }
}