<?php

namespace Form\ValueObject;

use Edefine\Framework\Storage\UploadedFile;

class TransactionImportObject
{
    private $file;
    private $hidden;

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getHidden()
    {
        return $this->hidden;
    }
}