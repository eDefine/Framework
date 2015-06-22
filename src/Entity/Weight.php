<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Weight extends AbstractEntity
{
    private $userId;
    private $value;
    private $date;
    private $info;

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
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

    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getTableName()
    {
        return 'weight';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'userId',
            'value',
            'date',
            'info'
        ];
    }

    public function getDateTimeFields()
    {
        return [
            'date'
        ];
    }
}