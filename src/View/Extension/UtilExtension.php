<?php

namespace View\Extension;

use Service\SettingManager;
use Version;

class UtilExtension extends \Twig_Extension
{
    private $settingManager;

    public function __construct(SettingManager $settingManager)
    {
        $this->settingManager = $settingManager;
    }

    public function getName()
    {
        return 'util';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('util_version', [$this, 'getVersion']),
            new \Twig_SimpleFunction('util_build', [$this, 'getBuild'])
        ];
    }

    public function getVersion()
    {
        return Version::VERSION;
    }

    public function getBuild()
    {
        return $this->settingManager->get('build_version');
    }
}