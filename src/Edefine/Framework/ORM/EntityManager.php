<?php

namespace Edefine\Framework\ORM;

use Edefine\Framework\Database\Connection;
use Edefine\Framework\Database\ValueConverter;
use Edefine\Framework\Entity\AbstractEntity;

/**
 * Class EntityManager
 * @package Edefine\Framework\ORM
 */
class EntityManager
{
    private $database;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->database = $connection;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function save(AbstractEntity $entity)
    {
        if ($entity->getId()) {
            return $this->updateEntity($entity);
        } else {
            return $this->saveNewEntity($entity);
        }
    }

    /**
     * @param AbstractEntity $entity
     * @throws \Edefine\Framework\Database\DatabaseException
     * @throws \RuntimeException
     */
    public function remove(AbstractEntity $entity)
    {
        if (!$entity->getId()) {
            throw new \RuntimeException('Entity was not persisted yet');
        }

        $this->database->exec(sprintf(
            'delete from %s where id = %d',
            $entity->getTableName(),
            $entity->getId()
        ));
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws \Edefine\Framework\Database\DatabaseException
     */
    private function saveNewEntity(AbstractEntity $entity)
    {
        $fieldsParts = [];
        foreach ($entity->getMappedFields() as $field) {
            $fieldsParts[] = sprintf('`%s`', $field);
        }

        $valuesParts = [];
        foreach ($entity->getMappedFieldsWithValues() as $field => $value) {
            $valuesParts[] = ValueConverter::convertToDatabase($value);
        }

        $result = $this->database->exec(sprintf(
            'insert into %s (%s) values (%s)',
            $entity->getTableName(),
            implode(', ', $fieldsParts),
            implode(', ', $valuesParts)
        ));

        $entity->setId($this->database->lastInsertId());

        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws \Edefine\Framework\Database\DatabaseException
     */
    private function updateEntity(AbstractEntity $entity)
    {
        $updateParts = [];
        foreach ($entity->getMappedFieldsWithValues() as $field => $value) {
            $updateParts[] = sprintf('`%s` = %s', $field, ValueConverter::convertToDatabase($value));
        }

        $result = $this->database->exec(sprintf(
            'update %s set %s where id = %d',
            $entity->getTableName(),
            implode(', ', $updateParts),
            $entity->getId()
        ));

        return $entity;
}