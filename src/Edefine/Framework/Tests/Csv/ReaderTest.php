<?php

namespace Edefine\Framework\Tests\Csv;

use Edefine\Framework\Csv\Reader;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Number of row elements (1) does not match header (2)
     */
    public function testParseThrowsExceptionWhenRowsFieldsDoesNotMatchHeader()
    {
        $reader = new Reader();

        $reader->parse(
            '"foo","bar"' . PHP_EOL .
            '"baz"'
        );
    }

    public function testParse()
    {
        $reader = new Reader();

        $this->assertEquals([
            ['Foo' => 'Value 1', 'Bar' => 'Value 2', 'Baz' => 'Value 3'],
            ['Foo' => 'Value 4', 'Bar' => 'Value 5', 'Baz' => 'Value 6']
        ], $reader->parse(
            '"Foo","Bar","Baz"' . PHP_EOL .
            '"Value 1","Value 2","Value 3"' . PHP_EOL .
            '"Value 4","Value 5","Value 6"' . PHP_EOL
        ));
    }
}
