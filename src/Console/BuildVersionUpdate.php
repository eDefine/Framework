<?php

namespace Console;

use Edefine\Framework\Console\AbstractJob;
use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;

class BuildVersionUpdate extends AbstractJob
{
    public function getName()
    {
        return 'build-version:update';
    }

    public function getInfo()
    {
        return 'Updates build version to current time';
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $date = new \DateTime();
        $buildVersion = $date->format('Y-m-d H:i:s');

        $this->getContainer()->get('settingManager')->set('build_version', $buildVersion);

        $output->writeln(sprintf('Build version set to %s', $buildVersion));
    }
}