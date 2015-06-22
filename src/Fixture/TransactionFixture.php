<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Category;
use Entity\Transaction;
use Entity\User;

class TransactionFixture extends  AbstractFixture
{
    public function getOrder()
    {
        return 10;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $user = $this->getContainer()->get('userRepository')->findOneById(1);

        $categories = $this->getContainer()->get('categoryRepository')->findAll();

        $transaction = $this->createTransaction($user, 'Papierosy', $this->getRandomElement($categories), 'LM Zielone', 14.20, new \DateTime('2014-01-01'));
        $manager->save($transaction);

        $transaction = $this->createTransaction($user, 'Papierosy', $this->getRandomElement($categories), 'LM Zielone', 14.20, new \DateTime('2014-02-02'));
        $manager->save($transaction);

        $transaction = $this->createTransaction($user, 'Papierosy', $this->getRandomElement($categories), 'LM Zielone', 14.20, new \DateTime('2014-03-03'));
        $manager->save($transaction);
    }

    private function createTransaction(User $user, $name, Category $category, $description, $value, \DateTime $transactionDate)
    {
        $transaction = new Transaction();

        $transaction->setUserId($user->getId());
        $transaction->setName($name);
        $transaction->setCategory($category);
        $transaction->setDescription($description);
        $transaction->setValue($value);
        $transaction->setTransactionDate($transactionDate);

        return $transaction;
    }
}