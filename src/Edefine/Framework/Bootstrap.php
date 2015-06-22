<?php

namespace Edefine\Framework;

use Edefine\Framework\Controller\ActionDispatcher;
use Edefine\Framework\Dependency\Container;
use Edefine\Framework\Event\RequestEvent;
use Edefine\Framework\Http\ResponseHandler;

/**
 * Class Bootstrap
 * @package Edefine\Framework
 */
class Bootstrap
{
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $request = $this->container->get('request');
        $this->container->get('dispatcher')->dispatch('kernel.request', new RequestEvent($request));
        $controllerPath = sprintf('Controller\%sController', $request->getControllerName());
        $actionMethod = sprintf('%sAction', $request->getActionName());

        $actionDispatcher = new ActionDispatcher($this->container);
        $response = $actionDispatcher->dispatch($controllerPath, $actionMethod);

        $responseHandler = new ResponseHandler();
        $responseHandler->handle($response);
    }
}