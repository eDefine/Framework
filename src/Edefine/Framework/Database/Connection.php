<?php

namespace Edefine\Framework\Database;

use Edefine\Framework\Config\Config;

/**
 * Class Connection
 * @package Edefine\Framework\Database
 */
class Connection
{
    private $pdo;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->pdo = new \PDO(
            sprintf('mysql:host=%s;dbname=%s;charset=utf8', $config->get('database.host'), $config->get('database.name')),
            $config->get('database.user'),
            $config->get('database.password')
        );
    }

    /**
     * @param $statement
     * @return array
     * @throws DatabaseException
     */
    public function query($statement)
    {
        $results = $this->pdo->query($statement);

        if ($results === false) {
            $errorArray = $this->pdo->errorInfo();
            throw new DatabaseException($errorArray[2]);
        }

        return $results->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $statement
     * @return int
     * @throws DatabaseException
     */
    public function exec($statement)
    {
        $result = $this->pdo->exec($statement);

        if ($result === false) {
            $errorArray = $this->pdo->errorInfo();
            throw new DatabaseException($errorArray[2]);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}