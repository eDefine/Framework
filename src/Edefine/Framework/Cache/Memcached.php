<?php

namespace Edefine\Framework\Cache;

use Edefine\Framework\Config\Config;

/**
 * Class Memcached
 * @package Edefine\Framework\Cache
 */
class Memcached implements CacheInterface
{
    private $memcached;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer(
            $config->get('memcached.host'),
            $config->get('memcached.port')
        );
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $result = $this->memcached->set($key, $value);

        if (!$result) {
            throw new \RuntimeException(sprintf('Cannot set memcached key %s', $key));
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->memcached->get($key);
    }
}