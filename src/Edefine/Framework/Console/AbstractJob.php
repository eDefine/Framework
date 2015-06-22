<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;
use Edefine\Framework\Dependency\Container;

/**
 * Class AbstractJob
 * @package Edefine\Framework\Console
 */
abstract class AbstractJob
{
    /** @var Container */
    private $container;

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

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->container;
    }
}