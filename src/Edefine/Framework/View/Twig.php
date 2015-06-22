<?php

namespace Edefine\Framework\View;

/**
 * Class Twig
 * @package Edefine\Framework\View
 */
class Twig
{
    private $twig;

    public function __construct()
    {
        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../../View');
        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * @param $name
     * @param array $data
     * @return string
     */
    public function render($name, array $data = [])
    {
        return $this->twig->render($name, $data);
    }

    /**
     * @param \Twig_Extension $extension
     */
    public function addExtension(\Twig_Extension $extension)
    {
        $this->twig->addExtension($extension);
    }
}