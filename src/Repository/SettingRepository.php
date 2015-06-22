<?php

namespace Repository;

use Edefine\Framework\ORM\AbstractRepository;

class SettingRepository extends AbstractRepository
{
    public function findOneByName($name)
    {
        $results = $this->findAll(['name' => $name]);

        if (count($results) == 0) {
            throw new \RuntimeException(sprintf('Setting with name %s was not found', $name));
        }

        return $results[0];
    }
}