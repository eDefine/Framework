<?php

namespace Edefine\Framework\View\Extension;

use Edefine\Framework\Session\FlashBag;

/**
 * Class FlashExtension
 * @package Edefine\Framework\View\Extension
 */
class FlashExtension extends \Twig_Extension
{
    private $flashBag;

    /**
     * @param FlashBag $flashBag
     */
    public function __construct(FlashBag $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'flash';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('flash', [$this, 'getFlash'])
        ];
    }

    /**
     * @param $type
     * @return array
     */
    public function getFlash($type)
    {
        return $this->flashBag->get($type);
    }
}