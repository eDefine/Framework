<?php

namespace Edefine\Framework\Console\Output;

/**
 * Class ChainOutput
 * @package Edefine\Framework\Console\Output
 */
class ChainOutput implements OutputInterface
{
    /** @var OutputInterface[] */
    private $outputs = [];

    /**
     * @param $message
     */
    public function writeln($message = '')
    {
        foreach ($this->outputs as $output) {
            $output->writeln($message);
        }
    }

    /**
     * @param $message
     */
    public function write($message = '')
    {
        foreach ($this->outputs as $output) {
            $output->write($message);
        }
    }

    /**
     * @param OutputInterface $output
     */
    public function addOutput(OutputInterface $output)
    {
        $this->outputs[] = $output;
    }
}