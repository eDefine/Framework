<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Interface JobInterface
 * @package Edefine\Framework\Console
 */
interface JobInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getInfo();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output);
}