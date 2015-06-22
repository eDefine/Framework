<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Meal;
use Entity\MealProduct;
use Entity\Product;

class MealProductFixture extends  AbstractFixture
{
    const MEAL_PRODUCTS_TO_CREATE = 100;

    public function getOrder()
    {
        return 7;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $meals = $this->getContainer()->get('mealRepository')->findAll();
        $products = $this->getContainer()->get('productRepository')->findAll();

        for ($i = 1; $i <= self::MEAL_PRODUCTS_TO_CREATE; $i++) {
            $mealProduct = $this->createMealProduct(
                $this->getRandomElement($meals),
                $this->getRandomElement($products),
                rand(0, 1000)
            );
            $manager->save($mealProduct);
        }
    }

    private function createMealProduct(Meal $meal, Product $product, $weight)
    {
        $mealProduct = new MealProduct();

        $mealProduct
            ->setMealId($meal->getId())
            ->setProductId($product->getId())
            ->setWeight($weight);

        return $mealProduct;
    }
}