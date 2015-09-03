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