<?php

namespace Edefine\Framework\Tests\Dependency;

use Edefine\Framework\Dependency\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $container = new Container();

        $container->add('foo', 'bar');

        $this->assertEquals('bar', $container->get('foo'));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Service foo does not exist
     */
    public function testGetThrowsExceptionWhenServiceIsNotSet()
    {
        $container = new Container();

        $container->get('foo');
    }

    public function testGetServices()
    {
        $container = new Container();

        $container->add('foo', 'fooService');
        $container->add('bar', 'barService');

        $this->assertCount(2, $container->getServices());
    }
}
