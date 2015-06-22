<?php

namespace Edefine\Framework\Cookie;

/**
 * Class Cookie
 * @package Edefine\Framework\Cookie
 */
class Cookie
{
    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * @param $name
     * @param null $default
     * @return null
     */
    public function get($name, $default = null)
    {
        if($this->has($name)) {
            return $_COOKIE[$name];
        }

        return $default;
    }

    /**
     * @param $name
     * @param $value
     * @param \DateTime $expire
     * @param string $domain
     */
    public function set($name, $value, \DateTime $expire = null, $domain = '/')
    {
        if (!$expire) {
            $expire = new \DateTime('+1 month');
        }

        setcookie($name, $value, $expire->getTimestamp(), $domain);
    }
}