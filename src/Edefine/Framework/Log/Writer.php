<?php

namespace Edefine\Framework\Log;

/**
 * Class Writer
 * @package Edefine\Framework\Log
 */
class Writer
{
    const STATUS_ERROR = 'error';
    const STATUS_WARNING = 'warning';
    const STATUS_DEBUG = 'debug';
    const STATUS_INFO = 'info';

    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;

        if (!file_exists($path)) {
            touch($path);
            chmod($path, 0777);
        }
    }

    /**
     * @param $message
     * @param string $status
     */
    public function log($message, $status = self::STATUS_DEBUG)
    {
        $date = date('Y-m-d H:i:s');
        $line = sprintf("[%s][%s]: %s\n", $status, $date, $message);

        file_put_contents($this->path, $line, FILE_APPEND);
    }

    /**
     * @param $message
     */
    public function logError($message)
    {
        $this->log($message, self::STATUS_ERROR);
    }

    /**
     * @param $message
     */
    public function logWarning($message)
    {
        $this->log($message, self::STATUS_WARNING);
    }

    /**
     * @param $message
     */
    public function logDebug($message)
    {
        $this->log($message, self::STATUS_DEBUG);
    }

    /**
     * @param $message
     */
    public function logInfo($message)
    {
        $this->log($message, self::STATUS_INFO);
    }
}