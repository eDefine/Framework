<?php

namespace Service;

use Edefine\Framework\ORM\EntityManager;
use Repository\SettingRepository;

class SettingManager
{
    private $entityManager;
    private $settingRepository;

    public function __construct(EntityManager $entityManager, SettingRepository $settingRepository)
    {
        $this->entityManager = $entityManager;
        $this->settingRepository = $settingRepository;
    }

    public function get($name)
    {
        $setting = $this->settingRepository->findOneByName($name);

        return $setting->getValue();
    }

    public function set($name, $value)
    {
        $setting = $this->settingRepository->findOneByName($name);
        $setting->setValue($value);
        $this->entityManager->save($setting);
    }
}