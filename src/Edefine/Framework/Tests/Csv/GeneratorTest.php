<?php

namespace Edefine\Framework\Tests\Csv;

use Edefine\Framework\Csv\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCsv()
    {
        $generator = new Generator(['foo', 'bar', 'baz']);

        $this->assertEquals('"foo","bar","baz"' . PHP_EOL, $generator->getCsv());

        $generator->addRow([1, 2, 3]);
        $generator->addRow(['test', null, '']);

        $this->assertEquals('"foo","bar","baz"' . PHP_EOL . '"1","2","3"' . PHP_EOL . '"test","",""' . PHP_EOL, $generator->getCsv());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Number of row elements (1) does not match header (2)
     */
    public function testAddRowThrowsExceptionWhenNumberOfColumnsDoesNotMatch()
    {
        $generator = new Generator(['foo', 'bar']);

        $generator->addRow(['baz']);
    }
}
