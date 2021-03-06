<?php

namespace Edefine\Framework\Controller;

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
    /**
     * @return \ServiceFactory
     */
    protected function getServiceFactory()
    {
        return \ServiceFactory::getInstance();
    }

    /**
     * @param array $data
     * @return HtmlResponse
     */
    protected function renderView(array $data = [])
    {
        $twig = $this->getServiceFactory()->getTwig();
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
        return $this->getServiceFactory()->getRequest();
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
        return $this->getServiceFactory()->getSession();
    }

    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @param bool|false $absolute
     * @return mixed
     */
    protected function getPath($controller, $action, array $params = [], $absolute = false)
    {
        return $this->getServiceFactory()->getRouter()->path($controller, $action, $params, $absolute);
    }
}