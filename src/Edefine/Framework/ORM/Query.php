<?php

namespace Edefine\Framework\ORM;

use Edefine\Framework\Database\Connection;
use Edefine\Framework\Database\ValueConverter;
use Edefine\Framework\Entity\AbstractEntity;

/**
 * Class Query
 * @package Edefine\Framework\ORM
 */
class Query
{
    private $entityClass;
    private $database;
    private $query;

    /**
     * @param $entityClass
     * @param Connection $connection
     * @param $query
     */
    public function __construct($entityClass, Connection $connection, $query)
    {
        $this->entityClass = $entityClass;
        $this->database = $connection;
        $this->query = $query;
    }

    /**
     * @return AbstractEntity[]
     * @throws \Edefine\Framework\Database\DatabaseException
     */
    public function execute()
    {
        $results = $this->database->query($this->query);

        $entities = [];
        foreach ($results as $result) {
            $entities[] = $this->mapToEntity($result);
        }

        return $entities;
    }

    /**
     * @param array $data
     * @return AbstractEntity
     */
    protected function mapToEntity(array $data)
    {
        /** @var AbstractEntity $entity */
        $entity = new $this->entityClass;

        foreach ($entity->getMappedFields() as $field) {
            $value = ValueConverter::convertToEntity($entity, $field, $data[$field]);

            $setter = 'set' . ucfirst($field);
            $entity->$setter($value);
        }

        return $entity;
    }
}