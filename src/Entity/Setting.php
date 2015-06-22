<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Setting extends AbstractEntity
{
    private $name;
    private $value;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getTableName()
    {
        return 'setting';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'name',
            'value'
        ];
    }
}