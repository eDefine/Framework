<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Transaction extends AbstractEntity
{
    private $userId;
    private $name;
    private $category;
    private $categoryId;
    private $description;
    private $value;
    private $transactionDate;

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        if ($category) {
            $this->setCategoryId($category->getId());
        }

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function setTransactionDate(\DateTime $transactionDate)
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    public function getTableName()
    {
        return 'transaction';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'userId',
            'name',
            'categoryId',
            'description',
            'value',
            'transactionDate'
        ];
    }

    public function getDateTimeFields()
    {
        return [
            'transactionDate'
        ];
    }
}