<?php

namespace Edefine\Framework\Storage;

/**
 * Class UploadedFile
 * @package Edefine\Framework\Storage
 */
class UploadedFile extends File
{
    private $error;

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