<?php

namespace Edefine\Framework\Event;

use Edefine\Framework\Http\Request;

/**
 * Class RequestEvent
 * @package Edefine\Framework\Event
 */
class RequestEvent
{
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}