<?php

namespace Edefine\Framework\Dependency;

/**
 * Class Container
 * @package Edefine\Framework\Dependency
 */
class Container
{
    private $services = [];

    /**
     * @param $serviceName
     * @return mixed
     * @throws \RuntimeException
     */
    public function get($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            throw new \RuntimeException("Service {$serviceName} does not exist");
        }

        return $this->services[$serviceName];
    }

    /**
     * @param $serviceName
     * @param $service
     */
    public function add($serviceName, $service)
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }
}