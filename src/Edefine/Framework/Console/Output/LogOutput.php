<?php

namespace Edefine\Framework\Console\Output;

use Edefine\Framework\Log\Writer;

/**
 * Class LogOutput
 * @package Edefine\Framework\Console\Output
 */
class LogOutput implements OutputInterface
{
    private $logger;

    /**
     * @param Writer $logger
     */
    public function __construct(Writer $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $message
     */
    public function writeln($message)
    {
        $this->logger->log($message);
    }

    /**
     * @param $message
     */
    public function write($message)
    {
        $this->writeln($message);
    }
}