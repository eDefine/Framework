<?php

namespace Service;

use Edefine\Framework\Log\Writer;
use Edefine\Framework\ORM\EntityManager;
use Edefine\Framework\Session\FlashBag;
use Entity\Transaction;

class TransactionManager
{
    private $manager;
    private $logger;
    private $flashBag;

    public function __construct(EntityManager $manager, Writer $logger, FlashBag $flashBag)
    {
        $this->manager = $manager;
        $this->logger = $logger;
        $this->flashBag = $flashBag;
    }

    public function save(Transaction $transaction)
    {
        $this->manager->save($transaction);

        $this->addMessage(sprintf('Transaction %s has been saved.', $transaction->getName()));

        return $transaction;
    }

    public function remove(Transaction $transaction)
    {
        $this->manager->remove($transaction);

        $this->addMessage(sprintf('Transaction %s has been removed.', $transaction->getName()));

        return $transaction;
    }

    private function addMessage($message)
    {
        $this->logger->logInfo($message);
        $this->flashBag->add('success', $message);
    }
}