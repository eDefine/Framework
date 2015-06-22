<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Product extends AbstractEntity
{
    private $name;
    private $weight;
    private $calories;

    public function getCaloriesPerGram()
    {
        if (!$this->weight) {
            return 0.0;
        }

        return $this->calories / $this->weight;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCalories()
    {
        return $this->calories;
    }

    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    public function getTableName()
    {
        return 'product';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'name',
            'weight',
            'calories'
        ];
    }
}