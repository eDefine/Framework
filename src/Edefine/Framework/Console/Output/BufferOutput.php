<?php

namespace Edefine\Framework\Console\Output;

/**
 * Class BufferOutput
 * @package Edefine\Framework\Console\Output
 */
class BufferOutput implements OutputInterface
{
    private $buffer = '';

    /**
     * @param $message
     */
    public function writeln($message = '')
    {
        $this->write($message . PHP_EOL);
    }

    /**
     * @param $message
     */
    public function write($message = '')
    {
        $this->buffer .= $message;
    }

    /**
     * @return string
     */
    public function getBuffer()
    {
        $buffer = $this->buffer;
        $this->buffer = '';

        return $buffer;
    }
}