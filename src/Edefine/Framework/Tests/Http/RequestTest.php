<?php

namespace Edefine\Framework\Tests\Http;

use Edefine\Framework\Cookie\Cookie;
use Edefine\Framework\Http\Request;
use Edefine\Framework\Session\Session;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testHasParam()
    {
        $_REQUEST = [
            'foo' => 'Foo',
            'bar' => 'Bar'
        ];

        $request = new Request(new Session(), new Cookie());

        $this->assertTrue($request->hasParam('foo'));
        $this->assertTrue($request->hasParam('bar'));

        $this->assertFalse($request->hasParam('baz'));
    }

    public function testGetParamWithoutDefaultArgument()
    {
        $_REQUEST = [
            'foo' => 'Foo',
            'bar' => 'Bar'
        ];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('Foo', $request->getParam('foo'));
        $this->assertEquals('Bar', $request->getParam('bar'));

        $this->assertNull($request->getParam('baz'));
    }

    public function testGetParamWithDefaultArgument()
    {
        $_REQUEST = [
            'foo' => 'Foo',
            'bar' => 'Bar'
        ];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('Foo', $request->getParam('foo', 'fooParam'));
        $this->assertEquals('Bar', $request->getParam('bar', 'barParam'));

        $this->assertEquals('bazParam', $request->getParam('baz', 'bazParam'));
    }

    public function testGetControllerNameWhenIsSet()
    {
        $_REQUEST = [
            'module' => 'Foo'
        ];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('Foo', $request->getControllerName());
    }

    public function testGetControllerNameReturnsHomeWhenNotSet()
    {
        $_REQUEST = [];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('Home', $request->getControllerName());
    }

    public function testGetActionNameWhenIsSet()
    {
        $_REQUEST = [
            'do' => 'foo'
        ];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('foo', $request->getActionName());
    }

    public function testGetActionNameReturnsIndexWhenNotSet()
    {
        $_REQUEST = [];

        $request = new Request(new Session(), new Cookie());

        $this->assertEquals('index', $request->getActionName());
    }
}