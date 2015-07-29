<?php

namespace Edefine\Framework\Fixture;

/**
 * Class AbstractFixture
 * @package Edefine\Framework\Fixture
 */
abstract class AbstractFixture
{
    /**
     * @return mixed
     */
    abstract public function load();

    /**
     * @return mixed
     */
    abstract public function getOrder();

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