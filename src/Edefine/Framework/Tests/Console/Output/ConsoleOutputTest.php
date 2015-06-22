<?php

namespace Edefine\Framework\Tests\Console\Input;

use Edefine\Framework\Console\Output\ConsoleOutput;

class ConsoleOutputTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteln()
    {
        $output = new ConsoleOutput();

        $output->writeln('Foo');
        $this->expectOutputString("Foo\n");
    }

    public function testWrite()
    {
        $output = new ConsoleOutput();

        $output->write('Foo');
        $this->expectOutputString('Foo');
    }
}