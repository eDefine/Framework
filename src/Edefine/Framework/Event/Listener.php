<?php

namespace Edefine\Framework\Event;

/**
 * Class Listener
 * @package Edefine\Framework\Event
 */
abstract class Listener
{
    /**
     * @param $event
     */
    abstract public function dispatch($event);

    /**
     * @return string
     */
    abstract public function getEventName();
}