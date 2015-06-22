<?php

namespace Edefine\Framework\Http;

/**
 * Class HtmlResponse
 * @package Edefine\Framework\Http
 */
class HtmlResponse extends Response
{
    /**
     * @param $content
     */
    public function __construct($content)
    {
        parent::__construct($content);

        $this->addHeader('Content-type: text/html; charset=utf-8');
    }
}