<?php

namespace Edefine\Framework\Fixture;

use Edefine\Framework\Dependency\Container;

/**
 * Class AbstractFixture
 * @package Edefine\Framework\Fixture
 */
abstract class AbstractFixture
{
    private $container;

    /**
     * @return mixed
     */
    abstract public function load();

    /**
     * @return mixed
     */
    abstract public function getOrder();

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * @param array $elements
     * @return mixed
     */
    protected function getRandomElement(array $elements)
    {
        return $elements[rand(0, count($elements) - 1)];
    }

    /**
     * @return bool
     */
    protected function getRandomBoolean()
    {
        return rand(0, 1) == 1;
    }
}