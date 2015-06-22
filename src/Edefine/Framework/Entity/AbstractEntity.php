<?php

namespace Edefine\Framework\Entity;

/**
 * Class AbstractEntity
 * @package Edefine\Framework\Entity
 */
abstract class AbstractEntity
{
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function getTableName();

    /**
     * @return array
     */
    abstract public function getMappedFields();

    /**
     * @return array
     */
    public function getMappedFieldsWithValues()
    {
        $result = [];

        foreach ($this->getMappedFields() as $field) {
            $getter = 'get' . ucfirst($field);

            $result[$field] = $this->$getter();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getDateTimeFields()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getArrayFields()
    {
        return [];
    }
}