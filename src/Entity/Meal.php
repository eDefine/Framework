<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Meal extends AbstractEntity
{
    private $userId;
    private $date;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getTableName()
    {
        return 'meal';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'userId',
            'date'
        ];
    }

    public function getDateTimeFields()
    {
        return [
            'date'
        ];
    }
}