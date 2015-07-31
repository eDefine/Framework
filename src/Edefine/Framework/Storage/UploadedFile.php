<?php

namespace Edefine\Framework\Storage;

/**
 * Class UploadedFile
 * @package Edefine\Framework\Storage
 */
class UploadedFile extends File
{
    private $size;
    private $error;

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}