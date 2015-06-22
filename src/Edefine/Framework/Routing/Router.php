<?php

namespace Edefine\Framework\Routing;

use Edefine\Framework\Config\Config;

/**
 * Class Router
 * @package Edefine\Framework\Routing
 */
class Router
{
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @return string
     */
    public function path($controller, $action, array $params = [])
    {
        if ($this->isModRewriteEnabled()) {
            return $this->urlFromArray(sprintf('/%s/%s', $controller, $action), $params);
        } else {
            if ($controller != $this->config->get('routing.default_controller')) {
                $params['module'] = $controller;
            }

            if ($action != $this->config->get('routing.default_action')) {
                $params['do'] = $action;
            }

            return $this->urlFromArray('/index.php', $params);
        }
    }

    /**
     * @param $path
     * @param array $params
     * @return string
     */
    private function urlFromArray($path, array $params = [])
    {
        $result = $path;
        if ($params) {
            $result .= '?';
        }

        $result .= http_build_query($params);

        return $result;
    }

    /**
     * @return bool
     */
    private function isModRewriteEnabled()
    {
        if (!function_exists('apache_get_modules')) {
            return false;
        }

        return in_array('mod_rewrite', apache_get_modules());
    }
}