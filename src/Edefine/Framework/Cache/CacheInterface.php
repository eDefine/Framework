<?php

namespace Edefine\Framework\Cache;

/**
 * Interface CacheInterface
 * @package Edefine\Framework\Cache
 */
interface CacheInterface
{
    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);
}