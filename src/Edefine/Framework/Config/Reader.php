<?php

namespace Edefine\Framework\Config;

/**
 * Class Reader
 * @package Edefine\Framework\Config
 */
class Reader
{
    /**
     * @param $path
     * @return Config
     */
    public function read($path)
    {
        $configArray = parse_ini_file($path, true);

        $config = new Config($configArray);

        return $config;
    }
}