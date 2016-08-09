<?php

namespace Edefine\Framework\Console\Output;

/**
 * Class ConsoleOutput
 * @package Edefine\Framework\Console\Output
 */
class ConsoleOutput implements OutputInterface
{
    /**
     * @param $message
     */
    public function writeln($message = '')
    {
        echo($message . PHP_EOL);
    }

    /**
     * @param $message
     */
    public function write($message = '')
    {
        echo($message);
    }
}