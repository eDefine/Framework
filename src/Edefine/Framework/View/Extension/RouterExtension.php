<?php

namespace Edefine\Framework\View\Extension;

use Edefine\Framework\Http\Request;
use Edefine\Framework\Routing\Router;

/**
 * Class RouterExtension
 * @package Edefine\Framework\View\Extension
 */
class RouterExtension extends \Twig_Extension
{
    private $router;
    private $request;

    /**
     * @param Router $router
     * @param Request $request
     */
    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'router';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('path', [$this, 'getPath']),
            new \Twig_SimpleFunction('route_matches', [$this, 'routeMatches'])
        ];
    }

    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @return string
     */
    public function getPath($controller, $action, array $params = [])
    {
        return $this->router->path($controller, $action, $params);
    }

    /**
     * @param $controller
     * @param null $action
     * @return bool
     */
    public function routeMatches($controller, $action = null)
    {
        if ($this->request->getControllerName() != ucfirst($controller)) {
            return false;
        }

        if ($action && $this->request->getActionName() != $action) {
            return false;
        }

        return true;
    }
}