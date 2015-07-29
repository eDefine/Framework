<?php

namespace Edefine\Framework\Tests\Controller;

use Edefine\Framework\Controller\AbstractController;
use Edefine\Framework\Controller\ActionDispatcher;
use Edefine\Framework\Http\Response;

class ActionDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /** @var ActionDispatcher */
    private $dispatcher;

    public function setUp()
    {
        $this->dispatcher = new ActionDispatcher();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Controller Edefine\Framework\Tests\Controller\BazController does not exist
     */
    public function testDispatchThrowsExceptionWhenControllerDoesNotExist()
    {
        $this->dispatcher->dispatch('Edefine\Framework\Tests\Controller\BazController', 'bazAction');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Action bazAction does not exist
     */
    public function testDispatchThrowsExceptionWhenActionDoesNotExist()
    {
        $this->dispatcher->dispatch('Edefine\Framework\Tests\Controller\FakeController', 'bazAction');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Action should return Response object
     */
    public function testDispatchThrowsExceptionWhenActionDoesNotReturnResponse()
    {
        $this->dispatcher->dispatch('Edefine\Framework\Tests\Controller\FakeController', 'barAction');
    }

    public function testDispatch()
    {
        $this->assertInstanceOf('Edefine\Framework\Http\Response', $this->dispatcher->dispatch('Edefine\Framework\Tests\Controller\FakeController', 'fooAction'));
    }
}

class FakeController extends AbstractController
{
    public function fooAction()
    {
        return new Response('foo');
    }

    public function barAction()
    {
        return 'bar';
    }
}