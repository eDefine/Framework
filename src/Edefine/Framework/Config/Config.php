<?php

namespace Edefine\Framework\Config;

/**
 * Class Config
 * @package Edefine\Framework\Config
 */
class Config
{
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $section => $configs) {
            foreach ($configs as $key => $value) {
                $this->data[sprintf('%s.%s', $section, $key)] = $value;
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws \RuntimeException
     */
    public function get($name)
    {
        if (!isset($this->data[$name])) {
            throw new \RuntimeException("Option {$name} is not set");
        }

        return $this->data[$name];
    }
}