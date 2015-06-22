<?php

namespace Edefine\Framework\Dependency;

use Edefine\Framework\Cache\Memcached;
use Edefine\Framework\Config\Reader;
use Edefine\Framework\Cookie\Cookie;
use Edefine\Framework\Database\Connection;
use Edefine\Framework\Event\Dispatcher;
use Edefine\Framework\Http\Request;
use Edefine\Framework\Log\Writer;
use Edefine\Framework\Mail\Mailer;
use Edefine\Framework\ORM\EntityManager;
use Edefine\Framework\Pdf\Generator;
use Edefine\Framework\Routing\Router;
use Edefine\Framework\Session\FlashBag;
use Edefine\Framework\Session\Session;
use Edefine\Framework\View\Extension\FlashExtension;
use Edefine\Framework\View\Extension\FormExtension;
use Edefine\Framework\View\Extension\RouterExtension;
use Edefine\Framework\View\Twig;

/**
 * Class Injection
 * @package Edefine\Framework\Dependency
 */
class Injection
{
    /**
     * @param $basePath
     * @return Container
     */
    public static function initContainer($basePath)
    {
        $container = new Container();

        $session = new Session();
        $container->add('session', $session);

        $cookie = new Cookie();
        $container->add('cookie', $cookie);

        $request = new Request($session, $cookie);
        $container->add('request', $request);

        $configReader = new Reader();
        $config = $configReader->read(sprintf('%s/config.ini', $basePath));
        $container->add('config', $config);

        $dbConnection = new Connection($config);
        $container->add('database', $dbConnection);

        $manager = new EntityManager($dbConnection);
        $container->add('manager', $manager);

        $memcached = new Memcached($config);
        $container->add('memcached', $memcached);

        $logger = new Writer(sprintf('%s/log/dev.log', $basePath));
        $container->add('logger', $logger);

        $router = new Router($config);
        $container->add('router', $router);

        $flashBag = new FlashBag($session);
        $container->add('flashBag', $flashBag);

        $pdfGenerator = new Generator($config);
        $container->add('pdfGenerator', $pdfGenerator);

        $mailer = new Mailer($config);
        $container->add('mailer', $mailer);

        $twig = new Twig(sprintf('%s/src/View', $basePath));
        $twig->addExtension(new FlashExtension($flashBag));
        $twig->addExtension(new RouterExtension($router, $request));
        $twig->addExtension(new FormExtension());
        $container->add('twig', $twig);

        $dispatcher = new Dispatcher();
        $container->add('dispatcher', $dispatcher);

        return $container;
    }
}