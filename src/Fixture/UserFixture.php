<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\User;

class UserFixture extends  AbstractFixture
{
    const USERS_TO_CREATE = 3;

    public function getOrder()
    {
        return 3;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $admin = $this->createAdmin('Patryk', 'Syc', 'patryk@edefine.pl', 'password');
        $manager->save($admin);

        for ($i = 1; $i <= self::USERS_TO_CREATE; $i++) {
            $user = $this->createUser("FirstName {$i}", "LastName {$i}", "user{$i}@edefine.pl", "password{$i}");
            $manager->save($user);
        }
    }

    private function createUser($firstName, $lastName, $email, $password)
    {
        $user = new User();

        $user
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email)
            ->setPlainPassword($password)
            ->addRole('USER');

        return $user;
    }

    private function createAdmin($firstName, $lastName, $email, $password)
    {
        $user = $this->createUser($firstName, $lastName, $email, $password);

        $user->addRole('ADMIN');

        return $user;
    }
}