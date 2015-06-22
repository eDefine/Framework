<?php

namespace Edefine\Framework\Controller;

use Edefine\Framework\Dependency\Container;
use Edefine\Framework\Http\HtmlResponse;
use Edefine\Framework\Http\RedirectResponse;
use Edefine\Framework\Http\Request;
use Edefine\Framework\Session\Session;

/**
 * Class AbstractController
 * @package Edefine\Framework\Controller
 */
abstract class AbstractController
{
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $data
     * @return HtmlResponse
     */
    protected function renderView(array $data = [])
    {
        $twig = $this->getContainer()->get('twig');
        $html = $twig->render(sprintf(
            '%s/%s.html.twig',
            $this->getRequest()->getControllerName(),
            $this->getRequest()->getActionName()
        ), $data);

        return new HtmlResponse($html);
    }

    /**
     * @param $url
     * @return RedirectResponse
     */
    protected function redirect($url)
    {
        return new RedirectResponse($url);
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->getContainer()->get('request');
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    protected function getParam($name, $default = null)
    {
        return $this->getRequest()->getParam($name, $default);
    }

    /**
     * @return Session
     */
    protected function getSession()
    {
        return $this->getContainer()->get('session');
    }

    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @return string
     */
    protected function getPath($controller, $action, array $params = [])
    {
        return $this->getContainer()->get('router')->path($controller, $action, $params);
    }
}