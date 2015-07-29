<?php

namespace Edefine\Framework\Http;

/**
 * Class JsonResponse
 * @package Edefine\Framework\Http
 */
class JsonResponse extends Response
{
    /**
     * @return string
     */
    public function getContent()
    {
        return json_encode($this->content);
    }
}