<?php

namespace Edefine\Framework\Tests\Routing;

use Edefine\Framework\Utils\Git;
use Edefine\Framework\Utils\System;

class SystemTest extends \PHPUnit_Framework_TestCase
{
    public function testChangingDirectories()
    {
        $system = new System();

        $rootDir = getcwd();
        $testsDir = sprintf('%s/src/Edefine/Framework/Tests', $rootDir);

        $this->assertEquals($rootDir, $system->pwd());

        $system->cd('src/Edefine');
        $system->cd('Framework');
        $system->cd('..');
        $system->cd('Framework/Tests');

        $this->assertEquals($testsDir, $system->pwd());
    }

    public function testExecute()
    {
        $system = new System();

        $returnCode = $system->execute('echo "Hello, World!" && echo "This is line 2"');

        $this->assertEquals(0, $returnCode);
        $this->assertEquals("Hello, World!\nThis is line 2", $system->getOutput());
        $this->assertEquals(['Hello, World!', 'This is line 2'], $system->getArrayOutput());
    }
}
