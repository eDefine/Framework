<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Country extends AbstractEntity
{
    private $name;
    private $code;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTableName()
    {
        return 'country';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'name',
            'code'
        ];
    }
}