<?php

namespace Edefine\Framework\Controller;

use Edefine\Framework\Http\Response;

/**
 * Class ActionDispatcher
 * @package Edefine\Framework\Controller
 */
class ActionDispatcher
{
    /**
     * @param $controllerPath
     * @param $actionMethod
     * @return Response
     */
    public function dispatch($controllerPath, $actionMethod)
    {
        if (!class_exists($controllerPath)) {
            throw new \InvalidArgumentException(sprintf('Controller %s does not exist', $controllerPath));
        }

        $controller = new $controllerPath();

        if (!method_exists($controller, $actionMethod)) {
            throw new \InvalidArgumentException(sprintf('Action %s does not exist', $actionMethod));
        }

        $response = $controller->$actionMethod();

        if (!$response instanceof Response) {
            throw new \RuntimeException('Action should return Response object');
        }

        return $response;
    }
}