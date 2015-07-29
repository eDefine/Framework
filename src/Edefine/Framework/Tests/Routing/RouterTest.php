<?php

namespace Edefine\Framework\Tests\Routing;

use Edefine\Framework\Config\Config;
use Edefine\Framework\Http\Server;
use Edefine\Framework\Routing\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Router */
    private $router;

    /** @var Server */
    private $server;

    public function setUp()
    {
        $config = new Config([
            'application' => [
                'domain' => 'framework.local'
            ],
            'routing' => [
                'default_controller' => 'my_controller',
                'default_action' => 'my_action'
            ]
        ]);

        $this->server = new Server();

        $this->router = new Router($config, $this->server);
    }

    public function testRelativePath()
    {
        $this->assertEquals('/index.php', $this->router->path('my_controller', 'my_action'));
        $this->assertEquals('/index.php?foo=123&bar=456', $this->router->path('my_controller', 'my_action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&module=controller', $this->router->path('controller', 'my_action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&do=action', $this->router->path('my_controller', 'action', ['foo' => '123', 'bar' => '456']));
        $this->assertEquals('/index.php?foo=123&bar=456&module=controller&do=action', $this->router->path('controller', 'action', ['foo' => '123', 'bar' => '456']));
    }

    public function testAbsolutePathFromConfig()
    {
        $this->assertEquals('http://framework.local/index.php', $this->router->path('my_controller', 'my_action', [], true));
        $this->assertEquals('http://framework.local/index.php?foo=123&bar=456', $this->router->path('my_controller', 'my_action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('http://framework.local/index.php?foo=123&bar=456&module=controller', $this->router->path('controller', 'my_action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('http://framework.local/index.php?foo=123&bar=456&do=action', $this->router->path('my_controller', 'action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('http://framework.local/index.php?foo=123&bar=456&module=controller&do=action', $this->router->path('controller', 'action', ['foo' => '123', 'bar' => '456'], true));
    }

    public function testAbsolutePathFromServer()
    {
        $this->server
            ->set('REQUEST_SCHEME', 'https')
            ->set('SERVER_NAME', 'domain.local');

        $this->assertEquals('https://domain.local/index.php', $this->router->path('my_controller', 'my_action', [], true));
        $this->assertEquals('https://domain.local/index.php?foo=123&bar=456', $this->router->path('my_controller', 'my_action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('https://domain.local/index.php?foo=123&bar=456&module=controller', $this->router->path('controller', 'my_action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('https://domain.local/index.php?foo=123&bar=456&do=action', $this->router->path('my_controller', 'action', ['foo' => '123', 'bar' => '456'], true));
        $this->assertEquals('https://domain.local/index.php?foo=123&bar=456&module=controller&do=action', $this->router->path('controller', 'action', ['foo' => '123', 'bar' => '456'], true));
    }
}
