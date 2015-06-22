<?php

namespace Edefine\Framework\Csv;

/**
 * Class Reader
 * @package Edefine\Framework\Csv
 */
class Reader
{
    /**
     * @param $data
     * @return array
     */
    public function parse($data)
    {
        $data = trim($data);
        $lines = explode(PHP_EOL, $data);

        $headerLine = array_shift($lines);
        $header = $this->getFieldsFromLine($headerLine);

        $rows = [];
        foreach ($lines as $line) {
            $rows[] = $this->parseLine($line, $header);
        }

        return $rows;
    }

    /**
     * @param $line
     * @param $header
     * @return array
     */
    private function parseLine($line, $header)
    {
        $fields = $this->getFieldsFromLine($line);

        if (count($fields) != count($header)) {
            throw new \RuntimeException(sprintf(
                'Number of row elements (%d) does not match header (%d)',
                count($fields),
                count($header)
            ));
        }

        $result = [];
        foreach ($header as $key => $value) {
            $result[$value] = $fields[$key];
        }

        return $result;
    }

    /**
     * @param $line
     * @return array
     */
    private function getFieldsFromLine($line)
    {
        $fields = explode(',', $line);

        $result = [];
        foreach ($fields as $field) {
            $result[] = trim($field, '"');
        }

        return $result;
    }
}