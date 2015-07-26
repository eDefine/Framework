<?php

namespace Edefine\Framework\Http;

use Edefine\Framework\Session\Session;
use Edefine\Framework\Cookie\Cookie;

/**
 * Class Request
 * @package Edefine\Framework\Http
 */
class Request
{
    private $data;
    private $files;
    private $session;
    private $cookie;

    /**
     * @param Session $session
     * @param Cookie $cookie
     */
    public function __construct(Session $session, Cookie $cookie)
    {
        $this->data = $_REQUEST;
        $this->files = $_FILES;

        $this->session = $session;
        $this->cookie = $cookie;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return Cookie
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasParam($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function getParam($name, $default = null)
    {
        if($this->hasParam($name)) {
            return $this->data[$name];
        }

        return $default;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return ucfirst($this->getParam('module', 'Home'));
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->getParam('do', 'index');
    }

    /**
     * @param $formName
     * @return bool
     */
    public function hasFiles($formName = null)
    {
        if ($formName) {
            return isset($this->files[$formName]);
        } else {
            return count($this->files) > 0;
        }
    }

    /**
     * @param $formName
     * @return array
     */
    public function getFiles($formName = null)
    {
        if (!$this->hasFiles($formName)) {
            return [];
        }

        if ($formName) {
            return UploadedFilesBuilder::buildFromNamedForm($this->files[$formName]);
        } else {
            return UploadedFilesBuilder::buildFromUnnamedForm($this->files);
        }
    }
}