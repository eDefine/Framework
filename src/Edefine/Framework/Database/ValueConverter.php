<?php

namespace Edefine\Framework\Database;

use Edefine\Framework\Entity\AbstractEntity;

/**
 * Class ValueConverter
 * @package Edefine\Framework\Database
 */
class ValueConverter
{
    /**
     * @param $value
     * @return string
     */
    public static function convertToDatabase($value)
    {
        if ($value instanceof \DateTime) {
            return sprintf('"%s"', $value->format('Y-m-d H:i:s'));
        }

        if ($value === null) {
            return 'NULL';
        }

        if (is_array($value)) {
            return sprintf('"%s"', addslashes(serialize($value)));
        }

        return sprintf('"%s"', addslashes($value));
    }

    /**
     * @param AbstractEntity $entity
     * @param $field
     * @param $value
     * @return \DateTime
     */
    public static function convertToEntity(AbstractEntity $entity, $field, $value)
    {
        if (in_array($field, $entity->getDateTimeFields())) {
            if ($value) {
                return new \DateTime($value);
            } else {
                return null;
            }
        }

        if (in_array($field, $entity->getArrayFields())) {
            return unserialize($value);
        }

        return $value;
    }
}