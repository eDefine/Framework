<?php

namespace Edefine\Framework\Session;

/**
 * Class Session
 * @package Edefine\Framework\Session
 */
class Session
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        if($this->has($name)) {
            return $_SESSION[$name];
        }

        return $default;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }
} 