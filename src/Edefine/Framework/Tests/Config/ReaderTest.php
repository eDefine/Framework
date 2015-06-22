<?php

namespace Edefine\Framework\Tests\Config;

use Edefine\Framework\Config\Reader;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testReadReturnsConfig()
    {
        $reader = new Reader();

        $config = $reader->read(sprintf('%s/data/sample.ini', __DIR__));
        $this->assertInstanceOf('Edefine\Framework\Config\Config', $config);
        $this->assertEquals('baz', $config->get('foo.bar'));
    }
}
