<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Category;

class CategoryFixture extends  AbstractFixture
{
    public function getOrder()
    {
        return 9;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $parent1 = $this->createCategory('Parent 1');
        $manager->save($parent1);

        $parent2 = $this->createCategory('Parent 2');
        $manager->save($parent2);

        $parent3 = $this->createCategory('Parent 3');
        $manager->save($parent3);

        for ($i = 1; $i <= 10; $i++) {
            $category = $this->createCategory(sprintf('%s - Child %d', $parent1->getName(), $i), $parent1);
            $manager->save($category);
        }

        for ($i = 1; $i <= 10; $i++) {
            $category = $this->createCategory(sprintf('%s - Child %d', $parent2->getName(), $i), $parent2);
            $manager->save($category);
        }
    }

    private function createCategory($name, Category $parent = null)
    {
        $category = new Category();

        $category->setName($name);
        $category->setParent($parent);

        return $category;
    }
}