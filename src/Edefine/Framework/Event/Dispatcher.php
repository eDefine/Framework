<?php

namespace Edefine\Framework\Event;

/**
 * Class Dispatcher
 * @package Edefine\Framework\Event
 */
class Dispatcher
{
    private $listeners = [];

    /**
     * @param $eventName
     * @param $event
     */
    public function dispatch($eventName, $event)
    {
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listener) {
                $listener->dispatch($event);
            }
        }
    }

    /**
     * @param Listener $listener
     * @return $this
     */
    public function addListener(Listener $listener)
    {
        $eventName = $listener->getEventName();

        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        $this->listeners[$eventName][] = $listener;

        return $this;
    }
}