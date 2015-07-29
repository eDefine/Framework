<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Class AbstractJob
 * @package Edefine\Framework\Console
 */
abstract class AbstractJob
{
    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return string
     */
    abstract public function getInfo();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    abstract public function run(InputInterface $input, OutputInterface $output);
}