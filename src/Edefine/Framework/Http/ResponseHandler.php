<?php

namespace Edefine\Framework\Http;

/**
 * Class ResponseHandler
 * @package Edefine\Framework\Http
 */
class ResponseHandler
{
    /**
     * @param Response $response
     */
    public function handle(Response $response)
    {
        foreach ($response->getHeaders() as $header) {
            header($header);
        }

        echo $response->getContent();
    }
}