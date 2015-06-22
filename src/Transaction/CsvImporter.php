<?php

namespace Transaction;

use Edefine\Framework\Csv\Reader;
use Edefine\Framework\ORM\EntityManager;
use Edefine\Framework\Storage\File;
use Entity\Transaction;

class CsvImporter
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function import(File $file)
    {
        $reader = new Reader();

        $array = $reader->parse($file->getContent());

        foreach ($array as $row) {
            $this->validateRow($row);

            $transaction = new Transaction();
            $transaction
                ->setName($row['Name'])
                ->setCategoryId($row['Category Id'])
                ->setDescription($row['Description'])
                ->setTransactionDate(new \DateTime($row['Transaction Date']))
                ->setValue($row['Value']);

            $this->manager->save($transaction);
        }

        return count($array);
    }

    private function validateRow(array $row)
    {
        $columns = [
            'Name',
            'Category Id',
            'Description',
            'Transaction Date',
            'Value'
        ];

        foreach ($columns as $column) {
            if (!isset($row[$column])) {
                throw new \RuntimeException(sprintf('Column %s is not set.', $column));
            }
        }
    }
}