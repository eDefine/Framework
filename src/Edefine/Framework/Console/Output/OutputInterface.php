<?php

namespace Edefine\Framework\Console\Output;

/**
 * Interface OutputInterface
 * @package Edefine\Framework\Console\Output
 */
interface OutputInterface
{
    /**
     * @param $message
     */
    public function writeln($message);

    /**
     * @param $message
     */
    public function write($message);
}