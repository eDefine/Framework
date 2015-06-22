<?php

namespace Edefine\Framework\Tests\Console\Input;

use Edefine\Framework\Console\Input\ArgvInput;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider argumentsNumberProvider
     */
    public function testGetArgumentsNumber($array, $number)
    {
        $input = new ArgvInput($array);

        $this->assertEquals($number, $input->getArgumentsNumber());
    }

    public function argumentsNumberProvider()
    {
        return [
            [[], 0],
            [['foo'], 0],
            [['foo', 'bar'], 1],
            [['foo', 'bar', 'baz'], 2]
        ];
    }

    public function testHasArgument()
    {
        $input = new ArgvInput(['foo', 'bar', 'baz']);

        $this->assertTrue($input->hasArgument(0));
        $this->assertTrue($input->hasArgument(1));

        $this->assertFalse($input->hasArgument(2));
    }

    public function testGetArgument()
    {
        $input = new ArgvInput(['foo', 'bar', 'baz']);

        $this->assertEquals('bar', $input->getArgument(0));
        $this->assertEquals('baz', $input->getArgument(1));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Token 123 is not set
     */
    public function testGetArgumentThrowsExceptionWhenArgumentIsNotSet()
    {
        $input = new ArgvInput([]);

        $input->getArgument(123);
    }
}
