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
     * @param $length
     * @param string $chars
     * @return string
     */
    protected function getRandomString($length, $chars = 'abcdefghijklmnopqrstuvwxyz')
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $result;
    }

    /**
     * @return bool
     */
    protected function getRandomBoolean()
    {
        return rand(0, 1) == 1;
    }
}