<?php

namespace Edefine\Framework\Console\Input;

/**
 * Class ArgvInput
 * @package Edefine\Framework\Console\Input
 */
class ArgvInput implements InputInterface
{
    private $tokens;

    /**
     * @param array $argv
     */
    public function __construct(array $argv = null)
    {
        if ($argv === null) {
            $argv = $_SERVER['argv'];
        }

        array_shift($argv);

        $this->tokens = $argv;
    }

    /**
     * @return int
     */
    public function getArgumentsNumber()
    {
        return count($this->tokens);
    }

    /**
     * @param $number
     * @return mixed
     * @throws \RuntimeException
     */
    public function getArgument($number)
    {
        if (!$this->hasArgument($number)) {
            throw new \RuntimeException(sprintf('Token %d is not set', $number));
        }

        return $this->tokens[$number];
    }

    /**
     * @param $number
     * @return bool
     */
    public function hasArgument($number)
    {
        return isset($this->tokens[$number]);
    }
}