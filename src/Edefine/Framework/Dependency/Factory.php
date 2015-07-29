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
    private static $instance;

    protected $session;
    protected $cookie;
    protected $request;
    protected $server;
    protected $config;
    protected $database;
    protected $entityManager;
    protected $memcached;
    protected $logger;
    protected $router;
    protected $flashBag;
    protected $pdfGenerator;
    protected $mailer;
    protected $twig;
    protected $dispatcher;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {}

    /**
     * @return Session\Session
     */
    public function getSession()
    {
        if (!$this->session) {
            $this->session = new Session\Session();
        }

        return $this->session;
    }

    /**
     * @return Cookie
     */
    public function getCookie()
    {
        if (!$this->cookie) {
            $this->cookie = new Cookie();
        }

        return $this->cookie;
    }

    /**
     * @return Http\Request
     */
    public function getRequest()
    {
        if (!$this->request) {
            $this->request = new Http\Request($this->getSession(), $this->getCookie());
        }

        return $this->request;
    }

    /**
     * @return Http\Server
     */
    public function getServer()
    {
        if (!$this->server) {
            $this->server = new Http\Server();
        }

        return $this->server;
    }

    /**
     * @return Config\Config
     */
    public function getConfig()
    {
        if (!$this->config) {
            $configReader = new Config\Reader();
            $this->config = $configReader->read(sprintf('%s/config.ini', APP_DIR));
        }

        return $this->config;
    }

    /**
     * @return Connection
     */
    public function getDatabase()
    {
        if (!$this->database) {
            $this->database = new Connection($this->getConfig());
        }

        return $this->database;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = new EntityManager($this->getDatabase());
        }

        return $this->entityManager;
    }

    /**
     * @return Memcached
     */
    public function getMemcached()
    {
        if (!$this->memcached) {
            $this->memcached = new Memcached($this->getConfig());
        }

        return $this->memcached;
    }

    /**
     * @return Writer
     */
    public function getLogger()
    {
        if (!$this->logger) {
            $this->logger = new Writer(sprintf('%s/log/dev.log', APP_DIR));
        }

        return $this->logger;
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        if (!$this->router) {
            $this->router = new Router($this->getConfig(), $this->getServer());
        }

        return $this->router;
    }

    /**
     * @return Session\FlashBag
     */
    public function getFlashBag()
    {
        if (!$this->flashBag) {
            $this->flashBag = new Session\FlashBag($this->getSession());
        }

        return $this->flashBag;
    }

    /**
     * @return Generator
     */
    public function getPdfGenerator()
    {
        if (!$this->pdfGenerator) {
            $this->pdfGenerator = new Generator($this->getConfig());
        }

        return $this->pdfGenerator;
    }

    /**
     * @return Mailer
     */
    public function getMailer()
    {
        if (!$this->mailer) {
            $this->mailer = new Mailer($this->getConfig());
        }

        return $this->mailer;
    }

    /**
     * @return Twig
     */
    public function getTwig()
    {
        if (!$this->twig) {
            $twig = new Twig(sprintf('%s/src/View', APP_DIR));
            $twig->addExtension(new TwigExtension\FlashExtension($this->getFlashBag()));
            $twig->addExtension(new TwigExtension\RouterExtension($this->getRouter(), $this->getRequest()));
            $twig->addExtension(new TwigExtension\FormExtension());
            $this->twig = $twig;
        }

        return $this->twig;
    }

    /**
     * @return Dispatcher
     */
    public function getDispatcher()
    {
        if (!$this->dispatcher) {
            $this->dispatcher = new Dispatcher();
        }

        return $this->dispatcher;
    }
}