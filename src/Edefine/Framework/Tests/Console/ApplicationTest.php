<?php

namespace Edefine\Framework\Tests\Console\Input;

use Edefine\Framework\Console\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testRun()
    {
        $inputMock = $this->getMockBuilder('Edefine\Framework\Console\Input\InputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $inputMock
            ->expects($this->any())
            ->method('hasArgument')
            ->with(0)
            ->will($this->returnValue(true));

        $inputMock
            ->expects($this->any())
            ->method('getArgument')
            ->with(0)
            ->will($this->returnValue('foo'));

        $outputMock = $this->getMockBuilder('Edefine\Framework\Console\Output\OutputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $jobMock = $this->getMockBuilder('Edefine\Framework\Console\JobInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $jobMock
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('foo'));

        $jobMock
            ->expects($this->once())
            ->method('run')
            ->with($inputMock, $outputMock);

        $application = new Application();
        $application->addJob($jobMock);

        $application->run($inputMock, $outputMock);
    }
}
