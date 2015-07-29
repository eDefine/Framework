<?php

namespace Edefine\Framework\Routing;

use Edefine\Framework\Config\Config;
use Edefine\Framework\Http\Server;

/**
 * Class Router
 * @package Edefine\Framework\Routing
 */
class Router
{
    private $config;
    private $server;

    /**
     * @param Config $config
     */
    public function __construct(Config $config, Server $server)
    {
        $this->config = $config;
        $this->server = $server;
    }

    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @return string
     */
    public function path($controller, $action, array $params = [], $absolute = false)
    {
        if ($this->isModRewriteEnabled()) {
            $url = $this->urlFromArray(sprintf('/%s/%s', $controller, $action), $params);
        } else {
            if ($controller != $this->config->get('routing.default_controller')) {
                $params['module'] = $controller;
            }

            if ($action != $this->config->get('routing.default_action')) {
                $params['do'] = $action;
            }

            $url = $this->urlFromArray('/index.php', $params);
        }

        if ($absolute) {
            return sprintf(
                '%s://%s%s',
                $this->server->get('REQUEST_SCHEME', 'http'),
                $this->server->get('SERVER_NAME', $this->config->get('application.domain')),
                $url
            );
        } else {
            return $url;
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