<?php

namespace Edefine\Framework\Http;
use Edefine\Framework\Storage\File;

/**
 * Class DownloadResponse
 * @package Edefine\Framework\Http
 */
class DownloadResponse extends Response
{
    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        parent::__construct($file->getContent());

        $this->addHeader(sprintf('Content-Type: %s', $file->getType()));
        $this->addHeader(sprintf('Content-Length: %s', $file->getSize()));
        $this->addHeader(sprintf('Content-Disposition: attachment; filename="%s"', $file->getName()));
    }
}