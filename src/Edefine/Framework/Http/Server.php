<?php

namespace Edefine\Framework\Http;

/**
 * Class Server
 * @package Edefine\Framework\Http
 */
class Server
{
    private $data;

    public function __construct()
    {
        $this->data = $_SERVER;
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        if($this->has($name)) {
            return $this->data[$name];
        }

        return $default;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }
}