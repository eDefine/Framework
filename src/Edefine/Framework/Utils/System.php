<?php

namespace Edefine\Framework\Utils;

/**
 * Class System
 * @package Edefine\Framework\Utils
 */
class System
{
    private $output;

    /**
     * @param $path
     */
    public function cd($path)
    {
        chdir($path);
    }

    /**
     * @return string
     */
    public function pwd()
    {
        return getcwd();
    }

    /**
     * @param $command
     * @return int
     */
    public function execute($command)
    {
        $this->output = null;

        exec($command, $this->output, $returnCode);

        return $returnCode;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return implode(PHP_EOL, $this->output);
    }
}