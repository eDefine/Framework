<?php

namespace Edefine\Framework\Http;

/**
 * Class RedirectResponse
 * @package Edefine\Framework\Http
 */
class RedirectResponse extends Response
{
    /**
     * @param $location
     */
    public function __construct($location)
    {
        $this->addHeader(sprintf('Location: %s', $location));
    }
}