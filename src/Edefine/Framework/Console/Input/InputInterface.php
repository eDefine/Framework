<?php

namespace Edefine\Framework\Console\Input;

/**
 * Interface InputInterface
 * @package Edefine\Framework\Console\Input
 */
interface InputInterface
{
    /**
     * @return int
     */
    public function getArgumentsNumber();

    /**
     * @param $number
     * @return mixed
     */
    public function getArgument($number);

    /**
     * @param $number
     * @return mixed
     */
    public function hasArgument($number);
}