<?php

namespace Transaction;

use Edefine\Framework\Csv\Generator;
use Edefine\Framework\Storage\MemoryFile;

class CsvGenerator
{
    public function generate(array $transactions)
    {
        $csv = new Generator(['Id', 'Name', 'Category Id', 'Description', 'Transaction Date', 'Value']);

        foreach ($transactions as $transaction) {
            $csv->addRow([
                $transaction->getId(),
                $transaction->getName(),
                $transaction->getCategoryId(),
                $transaction->getDescription(),
                $transaction->getTransactionDate()->format('d-m-Y'),
                $transaction->getValue()
            ]);
        }

        $csvFile = new MemoryFile();
        $csvFile
            ->setName('transactions.csv')
            ->setType('application/csv')
            ->setContent($csv->getCsv());

        return $csvFile;
    }
}