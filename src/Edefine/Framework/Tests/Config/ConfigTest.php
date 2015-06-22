<?php

namespace Edefine\Framework\Tests\Config;

use Edefine\Framework\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $config = new Config(['section' => ['foo' => 'bar']]);

        $this->assertEquals('bar', $config->get('section.foo'));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Option foo is not set
     */
    public function testGetThrowsExceptionWhenOptionIsNotSet()
    {
        $config = new Config();

        $config->get('foo');
    }
}
