<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\ArgvInput;
use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\ConsoleOutput;
use Edefine\Framework\Console\Output\OutputInterface;

/**
 * Class Application
 * @package Edefine\Framework\Console
 */
class Application
{
    /** @var AbstractJob[] */
    private $jobs = [];

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        if (!$input) {
            $input = new ArgvInput();
        }

        if (!$output) {
            $output = new ConsoleOutput();
        }

        if (!$input->hasArgument(0)) {
            $this->printJobsList($output);
        } else {
            $this->runJob($input->getArgument(0), $input, $output);
        }
    }

    /**
     * @param AbstractJob $job
     * @throws \RuntimeException
     */
    public function addJob(AbstractJob $job)
    {
        if (isset($this->jobs[$job->getName()])) {
            throw new \RuntimeException(sprintf('Job with name %s already exists', $job->getName()));
        }

        $this->jobs[$job->getName()] = $job;
    }

    /**
     * @param OutputInterface $output
     */
    private function printJobsList(OutputInterface $output)
    {
        foreach ($this->jobs as $job) {
            $output->writeln(sprintf("%s\t%s", $job->getName(), $job->getInfo()));
        }
    }

    /**
     * @param $jobName
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \RuntimeException
     */
    private function runJob($jobName, InputInterface $input, OutputInterface $output)
    {
        if (!isset($this->jobs[$jobName])) {
            throw new \RuntimeException(sprintf('Job with name %s does not exist', $jobName));
        }

        $container = \DependencyInjection::initContainer();

        $job = $this->jobs[$jobName];
        $job->setContainer($container);
        $job->run($input, $output);
    }
}