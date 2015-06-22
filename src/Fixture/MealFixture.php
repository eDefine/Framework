<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Meal;
use Entity\User;

class MealFixture extends  AbstractFixture
{
    const MEALS_TO_CREATE = 100;

    public function getOrder()
    {
        return 6;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $users = $this->getContainer()->get('userRepository')->findAll();

        for ($i = 1; $i <= self::MEALS_TO_CREATE; $i++) {
            $meal = $this->createMeal($this->getRandomElement($users), $this->getRandomDate());
            $manager->save($meal);
        }
    }

    private function createMeal(User $user, \DateTime $date)
    {
        $meal = new Meal();

        $meal
            ->setUserId($user->getId())
            ->setDate($date);

        return $meal;
    }

    private function getRandomDate()
    {
        $date = new \DateTime(sprintf('-%d days', rand(0, 1000)));

        $date->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

        return $date;
    }
}