<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\ArgvInput;
use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\ConsoleOutput;
use Edefine\Framework\Console\Output\OutputInterface;
use Edefine\Framework\Dependency\Container;

/**
 * Class Application
 * @package Edefine\Framework\Console
 */
class Application
{
    private $container;

    /** @var AbstractJob[] */
    private $jobs = [];

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

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
        $sections = [];
        $maxLength = 0;
        foreach ($this->jobs as $job) {
            $maxLength = max($maxLength, strlen($job->getName()));
            $nameParams = explode(':', $job->getName());
            $sections[$nameParams[0]][] = $job;
        }

        foreach ($sections as $section => $jobs) {
            $output->writeln(sprintf('%s:', $section));

            foreach ($jobs as $job) {
                $spacesNumber = $maxLength - strlen($job->getName()) + 1;

                $output->writeln(sprintf(
                    "\t%s%s%s",
                    $job->getName(),
                    str_repeat(' ', $spacesNumber),
                    $job->getInfo()
                ));
            }
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

        $job = $this->jobs[$jobName];
        $job->setContainer($this->container);
        $job->run($input, $output);
    }
}