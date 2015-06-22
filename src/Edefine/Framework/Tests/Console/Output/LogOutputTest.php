<?php

namespace Edefine\Framework\Tests\Console\Input;

use Edefine\Framework\Console\Output\LogOutput;

class LogOutputTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteln()
    {
        $loggerMock = $this->getMockBuilder('Edefine\Framework\Log\Writer')
            ->disableOriginalConstructor()
            ->getMock();

        $loggerMock
            ->expects($this->once())
            ->method('log')
            ->with('Foo');

        $output = new LogOutput($loggerMock);

        $output->writeln('Foo');
    }

    public function testWrite()
    {
        $loggerMock = $this->getMockBuilder('Edefine\Framework\Log\Writer')
            ->disableOriginalConstructor()
            ->getMock();

        $loggerMock
            ->expects($this->once())
            ->method('log')
            ->with('Foo');

        $output = new LogOutput($loggerMock);

        $output->write('Foo');
    }
}