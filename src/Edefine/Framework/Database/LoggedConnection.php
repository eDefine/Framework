<?php

namespace Edefine\Framework\Database;

use Edefine\Framework\Config\Config;
use Edefine\Framework\Log\Writer;

/**
 * Class LoggedConnection
 * @package Edefine\Framework\Database
 */
class LoggedConnection extends Connection
{
    private $logger;

    /**
     * @param Config $config
     * @param Writer $logger
     */
    public function __construct(Config $config, Writer $logger)
    {
        parent::__construct($config);

        $this->logger = $logger;
    }

    /**
     * @param $statement
     * @return array
     * @throws DatabaseException
     */
    public function query($statement)
    {
        $this->logger->log($statement);

        return parent::query($statement);
    }

    /**
     * @param $statement
     * @return int
     * @throws DatabaseException
     */
    public function exec($statement)
    {
        $this->logger->log($statement);

        return parent::exec($statement);
    }
}