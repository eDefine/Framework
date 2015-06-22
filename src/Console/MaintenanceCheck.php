<?php

namespace Console;

use Edefine\Framework\Console\AbstractJob;
use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

class MaintenanceCheck extends AbstractJob
{
    public function getName()
    {
        return 'maintenance:check';
    }

    public function getInfo()
    {
        return 'Check if maintenance mode is enabled';
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $maintenanceMode = $this->getContainer()->get('settingManager')->get('maintenance_mode');

        if ($maintenanceMode) {
            $output->writeln('Maintenance mode is enabled');
        } else {
            $output->writeln('Maintenance mode is disabled');
        }
    }
}