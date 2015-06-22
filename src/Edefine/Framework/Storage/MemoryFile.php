<?php

namespace Edefine\Framework\Storage;

/**
 * Class MemoryFile
 * @package Edefine\Framework\Storage
 */
class MemoryFile extends File
{
    private $content;

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}