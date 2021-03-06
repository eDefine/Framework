<?php

namespace Edefine\Framework\Http;

/**
 * Class Response
 * @package Edefine\Framework\Http
 */
class Response
{
    protected $content;
    private $headers = [];

    /**
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $header
     * @return $this
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}