<?php

namespace Edefine\Framework\Csv;

/**
 * Class Generator
 * @package Edefine\Framework\Csv
 */
class Generator
{
    private $header;
    private $rows = [];

    /**
     * @param array $header
     */
    public function __construct(array $header)
    {
        $this->header = $header;
    }

    /**
     * @param array $row
     */
    public function addRow(array $row)
    {
        if (count($row) != count($this->header)) {
            throw new \RuntimeException(sprintf(
                'Number of row elements (%d) does not match header (%d)',
                count($row),
                count($this->header)
            ));
        }

        $this->rows[] = $row;
    }

    /**
     * @return string
     */
    public function getCsv()
    {
        $result = $this->getCsvLine($this->header);

        foreach ($this->rows as $row) {
            $result .= $this->getCsvLine($row);
        }

        return $result;
    }

    /**
     * @param array $row
     * @return string
     */
    private function getCsvLine(array $row)
    {
        $parts = [];

        foreach ($row as $field) {
            $parts[] = sprintf('"%s"', $field);
        }

        return implode(',', $parts) . PHP_EOL;
    }
}