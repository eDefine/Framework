<?php

namespace Edefine\Framework\Dependency;

use Edefine\Framework\Cache\Memcached;
use Edefine\Framework\Config;
use Edefine\Framework\Cookie\Cookie;
use Edefine\Framework\Database\Connection;
use Edefine\Framework\Event\Dispatcher;
use Edefine\Framework\Http;
use Edefine\Framework\Log\Writer;
use Edefine\Framework\Mail\Mailer;
use Edefine\Framework\ORM\EntityManager;
use Edefine\Framework\Pdf\Generator;
use Edefine\Framework\Routing\Router;
use Edefine\Framework\Session;
use Edefine\Framework\View\Extension as TwigExtension;
use Edefine\Framework\View\Twig;

class Factory
{
    protected static $session;
    protected static $cookie;
    protected static $request;
    protected static $server;
    protected static $config;
    protected static $database;
    protected static $entityManager;
    protected static $memcached;
    protected static $logger;
    protected static $router;
    protected static $flashBag;
    protected static $pdfGenerator;
    protected static $mailer;
    protected static $twig;
    protected static $dispatcher;

    /**
     * @return Session\Session
     */
    public static function getSession()
    {
        if (!self::$session) {
            self::$session = new Session\Session();
        }

        return self::$session;
    }

    /**
     * @return Cookie
     */
    public static function getCookie()
    {
        if (!self::$cookie) {
            self::$cookie = new Cookie();
        }

        return self::$cookie;
    }

    /**
     * @return Http\Request
     */
    public static function getRequest()
    {
        if (!self::$request) {
            self::$request = new Http\Request(self::getSession(), self::getCookie());
        }

        return self::$request;
    }

    /**
     * @return Http\Server
     */
    public static function getServer()
    {
        if (!self::$server) {
            self::$server = new Http\Server();
        }

        return self::$server;
    }

    /**
     * @return Config\Config
     */
    public static function getConfig()
    {
        if (!self::$config) {
            $configReader = new Config\Reader();
            self::$config = $configReader->read(sprintf('%s/config.ini', APP_DIR));
        }

        return self::$config;
    }

    /**
     * @return Connection
     */
    public static function getDatabase()
    {
        if (!self::$database) {
            self::$database = new Connection(self::getConfig());
        }

        return self::$database;
    }

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        if (!self::$entityManager) {
            self::$entityManager = new EntityManager(self::getDatabase());
        }

        return self::$entityManager;
    }

    /**
     * @return Memcached
     */
    public static function getMemcached()
    {
        if (!self::$memcached) {
            self::$memcached = new Memcached(self::getConfig());
        }

        return self::$memcached;
    }

    /**
     * @return Writer
     */
    public static function getLogger()
    {
        if (!self::$logger) {
            self::$logger = new Writer(sprintf('%s/log/dev.log', APP_DIR));
        }

        return self::$logger;
    }

    /**
     * @return Router
     */
    public static function getRouter()
    {
        if (!self::$router) {
            self::$router = new Router(self::getConfig(), self::getServer());
        }

        return self::$router;
    }

    /**
     * @return Session\FlashBag
     */
    public static function getFlashBag()
    {
        if (!self::$flashBag) {
            self::$flashBag = new Session\FlashBag(self::getSession());
        }

        return self::$flashBag;
    }

    /**
     * @return Generator
     */
    public static function getPdfGenerator()
    {
        if (!self::$pdfGenerator) {
            self::$pdfGenerator = new Generator(self::getConfig());
        }

        return self::$pdfGenerator;
    }

    /**
     * @return Mailer
     */
    public static function getMailer()
    {
        if (!self::$mailer) {
            self::$mailer = new Mailer(self::getConfig());
        }

        return self::$mailer;
    }

    /**
     * @return Twig
     */
    public static function getTwig()
    {
        if (!self::$twig) {
            $twig = new Twig(sprintf('%s/src/View', APP_DIR));
            $twig->addExtension(new TwigExtension\FlashExtension(self::getFlashBag()));
            $twig->addExtension(new TwigExtension\RouterExtension(self::getRouter(), self::getRequest()));
            $twig->addExtension(new TwigExtension\FormExtension());
            self::$twig = $twig;
        }

        return self::$twig;
    }

    /**
     * @return Dispatcher
     */
    public static function getDispatcher()
    {
        if (!self::$dispatcher) {
            self::$dispatcher = new Dispatcher();
        }

        return self::$dispatcher;
    }
}