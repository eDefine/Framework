<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Setting;

class SettingFixture extends  AbstractFixture
{
    public function getOrder()
    {
        return 1;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $maintenanceMode = $this->createSetting('maintenance_mode', 0);
        $manager->save($maintenanceMode);

        $ownerEmail = $this->createSetting('owner_email', 'patryk@edefine.pl');
        $manager->save($ownerEmail);

        $buildVersion = $this->createSetting('build_version', '');
        $manager->save($buildVersion);
    }

    private function createSetting($name, $value)
    {
        $setting = new Setting();

        $setting
            ->setName($name)
            ->setValue($value);

        return $setting;
    }
}