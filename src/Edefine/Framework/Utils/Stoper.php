<?php

namespace Edefine\Framework\Utils;

/**
 * Class Stoper
 * @package Edefine\Framework\Utils
 */
class Stoper
{
    private $startTime;

    public function start()
    {
        $this->startTime = microtime(true);
    }

    public function stop()
    {
        $stopTime = microtime(true);
        return $stopTime - $this->startTime;
    }
}