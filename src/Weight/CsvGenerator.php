<?php

namespace Weight;

use Edefine\Framework\Csv\Generator;
use Edefine\Framework\Storage\MemoryFile;

class CsvGenerator
{
    public function generate(array $weights)
    {
        $csv = new Generator(['Date', 'Value', 'Info']);

        foreach ($weights as $weight) {
            $csv->addRow([
                $weight->getDate()->format('d-m-Y H:i:s'),
                $weight->getValue(),
                $weight->getInfo()
            ]);
        }

        $csvFile = new MemoryFile();
        $csvFile
            ->setName('weights.csv')
            ->setType('application/csv')
            ->setContent($csv->getCsv());

        return $csvFile;
    }
}