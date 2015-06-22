<?php

namespace Edefine\Framework\Pdf;

use Edefine\Framework\Config\Config;
use Edefine\Framework\Storage\File;

/**
 * Class Generator
 * @package Edefine\Framework\Pdf
 */
class Generator
{
    private $binary;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->binary = $config->get('wkhtmltopdf.binary');
    }

    /**
     * @param $html
     * @return File
     * @throws \Exception
     */
    public function generate($html)
    {
        $tempName = md5(rand());

        $htmlFile = new File();
        $htmlFile
            ->setPath(sprintf('%s/tmp/%s.html', APP_DIR, $tempName))
            ->setContent($html);

        $pdfFile = new File();
        $pdfFile
            ->setName(sprintf('%s.pdf', $tempName))
            ->setPath(sprintf('%s/tmp/%s.pdf', APP_DIR, $tempName))
            ->setType('application/pdf');

        exec(sprintf('%s %s %s', $this->getBinaryPath(), $htmlFile->getPath(), $pdfFile->getPath()));

        return $pdfFile;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getBinaryPath()
    {
        if (file_exists($this->binary)) {
            return $this->binary;
        } elseif (file_exists(sprintf('%s/%s', APP_DIR, $this->binary))) {
            return sprintf('%s/%s', APP_DIR, $this->binary);
        } else {
            throw new \Exception(sprintf(
                'Neither %s nor %s/%s is a valid binary path',
                $this->binary,
                APP_DIR,
                $this->binary
            ));
        }
    }
}