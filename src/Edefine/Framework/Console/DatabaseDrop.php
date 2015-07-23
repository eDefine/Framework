<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Class DatabaseDrop
 * @package Edefine\Framework\Console
 */
class DatabaseDrop extends AbstractJob
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'database:drop';
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return 'Drops database';
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->get('config');
        $databaseName = $config->get('database.name');

        $database = $this->getContainer()->get('database');
        $database->query(sprintf('DROP DATABASE %s', $databaseName));

        $output->writeln(sprintf('Database %s dropped', $databaseName));
    }
}