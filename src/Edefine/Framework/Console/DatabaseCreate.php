<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Class DatabaseCreate
 * @package Edefine\Framework\Console
 */
class DatabaseCreate extends AbstractJob
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'database:create';
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return 'Creates database';
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
        $database->query(sprintf('CREATE DATABASE %s', $databaseName));

        $output->writeln(sprintf('Database %s created', $databaseName));
    }
}