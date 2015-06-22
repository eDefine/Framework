<?php

namespace Edefine\Framework\Tests\Log;

use Edefine\Framework\Log\Writer;

class WriterTest extends \PHPUnit_Framework_TestCase
{
    const TEST_FILE = '/data/test.log';

    public function setUp()
    {
        $this->removeTestFile();
    }

    public function tearDown()
    {
        $this->removeTestFile();
    }

    public function testConstructCreatesEmptyFile()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $this->assertFileExists($path);
        $this->assertStringEqualsFile($path, '');
    }

    public function testLog()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $writer->log('Foo', 'Bar');
        $loggedData = file_get_contents($path);

        $this->assertRegExp('/^\[Bar\]\[.*\]: Foo$/', $loggedData);
    }

    public function testLogError()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $writer->logError('Foo');
        $loggedData = file_get_contents($path);

        $this->assertRegExp('/^\[error\]\[.*\]: Foo$/', $loggedData);
    }

    public function testLogWarning()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $writer->logWarning('Foo');
        $loggedData = file_get_contents($path);

        $this->assertRegExp('/^\[warning\]\[.*\]: Foo$/', $loggedData);
    }

    public function testLogDebug()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $writer->logDebug('Foo');
        $loggedData = file_get_contents($path);

        $this->assertRegExp('/^\[debug\]\[.*\]: Foo$/', $loggedData);
    }

    public function testLogInfo()
    {
        $path = $this->getTestFilePath();
        $writer = new Writer($path);

        $writer->logInfo('Foo');
        $loggedData = file_get_contents($path);

        $this->assertRegExp('/^\[info\]\[.*\]: Foo$/', $loggedData);
    }

    private function removeTestFile()
    {
        $path = $this->getTestFilePath();
        if (file_exists($path)) {
            unlink($path);
        }
    }

    private function getTestFilePath()
    {
        return __DIR__ . self::TEST_FILE;
    }
}