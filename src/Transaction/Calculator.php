<?php

namespace Transaction;

use Entity\Transaction;

class Calculator
{
    /** @var Transaction[] */
    private $transactions;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function getTotalValue()
    {
        $totalValue = 0.0;
        foreach ($this->transactions as $transaction) {
            $totalValue += $transaction->getValue();
        }

        return $totalValue;
    }
}