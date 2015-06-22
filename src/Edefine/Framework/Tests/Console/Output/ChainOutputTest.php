<?php

namespace Edefine\Framework\Tests\Console\Input;

use Edefine\Framework\Console\Output\ChainOutput;

class ChainOutputTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteln()
    {
        $outputMock = $this->getMockBuilder('Edefine\Framework\Console\Output\OutputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $outputMock
            ->expects($this->exactly(3))
            ->method('writeln')
            ->with('Foo');

        $output = new ChainOutput();
        $output->addOutput($outputMock);
        $output->addOutput($outputMock);
        $output->addOutput($outputMock);

        $output->writeln('Foo');
    }

    public function testWrite()
    {
        $outputMock = $this->getMockBuilder('Edefine\Framework\Console\Output\OutputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $outputMock
            ->expects($this->exactly(3))
            ->method('write')
            ->with('Foo');

        $output = new ChainOutput();
        $output->addOutput($outputMock);
        $output->addOutput($outputMock);
        $output->addOutput($outputMock);

        $output->write('Foo');
    }
}