<?php

namespace Edefine\Framework;

use Edefine\Framework\Controller\ActionDispatcher;
use Edefine\Framework\Event\RequestEvent;
use Edefine\Framework\Http\ResponseHandler;

/**
 * Class Bootstrap
 * @package Edefine\Framework
 */
class Bootstrap
{
    public function run()
    {
        $request = \DependencyFactory::getRequest();
        \DependencyFactory::getDispatcher()->dispatch('kernel.request', new RequestEvent($request));
        $controllerPath = sprintf('Controller\%sController', $request->getControllerName());
        $actionMethod = sprintf('%sAction', $request->getActionName());

        $actionDispatcher = new ActionDispatcher();
        $response = $actionDispatcher->dispatch($controllerPath, $actionMethod);

        $responseHandler = new ResponseHandler();
        $responseHandler->handle($response);
    }
}