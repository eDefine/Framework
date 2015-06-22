<?php

namespace Edefine\Framework\Http;
use Edefine\Framework\Storage\File;

/**
 * Class DownloadResponse
 * @package Edefine\Framework\Http
 */
class DownloadResponse extends Response
{
    private $file;

    public function __construct(File $file)
    {
        $this->file = $file;

        $this->addHeader(sprintf('Content-Type: %s', $file->getType()));
        $this->addHeader(sprintf('Content-Disposition: attachment; filename="%s"', $file->getName()));
    }

    public function getContent()
    {
        return $this->file->getContent();
    }
}