<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Product;

class ProductFixture extends  AbstractFixture
{
    public function getOrder()
    {
        return 5;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $deseczka = $this->createProduct('Deseczka', 5.3, 20);
        $manager->save($deseczka);

        $cola = $this->createProduct('Coca Cola', 1000, 450);
        $manager->save($cola);
    }

    private function createProduct($name, $weight, $calories)
    {
        $product = new Product();

        $product
            ->setName($name)
            ->setWeight($weight)
            ->setCalories($calories);

        return $product;
    }
}