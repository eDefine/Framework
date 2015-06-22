<?php

namespace Edefine\Framework\Session;

/**
 * Class FlashBag
 * @package Edefine\Framework\Session
 */
class FlashBag
{
    const SESSION_KEY = 'flashMessages';

    private $session;
    private $messages;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->messages = $session->get(self::SESSION_KEY, []);
    }

    /**
     * @param $type
     * @param $message
     */
    public function add($type, $message)
    {
        if (!isset($this->messages[$type])) {
            $this->messages[$type] = [];
        }

        $this->messages[$type][] = $message;

        $this->updateSession();
    }

    /**
     * @param $type
     * @return array
     */
    public function get($type)
    {
        if (!isset($this->messages[$type])) {
            return [];
        }

        $result = $this->messages[$type];

        unset($this->messages[$type]);
        $this->updateSession();

        return $result;
    }

    private function updateSession()
    {
        $this->session->set(self::SESSION_KEY, $this->messages);
    }
} 