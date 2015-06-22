<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Class ContainerList
 * @package Edefine\Framework\Console
 */
class ContainerList extends AbstractJob
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'container:list';
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return 'List services in dependency container';
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $services = $this->getContainer()->getServices();

        foreach ($services as $name => $service) {
            $output->writeln(sprintf('%s: %s', $name, get_class($service)));
        }
    }
}