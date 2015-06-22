<?php

namespace Edefine\Framework\Tests\Routing;

use Edefine\Framework\Config\Config;
use Edefine\Framework\Routing\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Router */
    private $router;

    public function setUp()
    {
        $config = new Config(['routing' => [
            'default_controller' => 'my_controller',
            'default_action' => 'my_action'
        ]]);

        $this->router = new Router($config);
    }

    public function testPath()
    {
        $this->assertEquals('/index.php', $this->router->path('my_controller', 'my_action'));
        $this->assertEquals('/index.php?foo=123&bar=456', $this->router->path('my_controller', 'my_action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&module=controller', $this->router->path('controller', 'my_action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&do=action', $this->router->path('my_controller', 'action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&module=controller&do=action', $this->router->path('controller', 'action', ['foo' => '123', 'bar' => '456']));
    }
}
