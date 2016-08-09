<?php

namespace Edefine\Framework\Console\Output;

/**
 * Interface OutputInterface
 * @package Edefine\Framework\Console\Output
 */
interface OutputInterface
{
    /**
     * @param string $message
     */
    public function writeln($message = '');

    /**
     * @param string $message
     */
    public function write($message = '');
}