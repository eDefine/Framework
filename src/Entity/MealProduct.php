<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class MealProduct extends AbstractEntity
{
    private $mealId;
    private $productId;
    private $weight;

    public function getMealId()
    {
        return $this->mealId;
    }

    public function setMealId($mealId)
    {
        $this->mealId = $mealId;

        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;

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

    public function getTableName()
    {
        return 'meal_product';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'mealId',
            'productId',
            'weight'
        ];
    }
}