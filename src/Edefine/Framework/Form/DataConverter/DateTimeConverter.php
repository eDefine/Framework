<?php

namespace Edefine\Framework\Form\DataConverter;

/**
 * Class DateTimeConverter
 * @package Edefine\Framework\Form\DataConverter
 */
class DateTimeConverter implements ConverterInterface
{
    /**
     * @param $formValue
     * @return \DateTime
     */
    public function convertToEntity($formValue)
    {
        if (!$formValue) {
            return null;
        }

        return new \DateTime($formValue);
    }

    /**
     * @param $entityValue
     * @return string
     */
    public function convertToForm($entityValue)
    {
        if (!$entityValue) {
            return null;
        }

        /** @var \DateTime $entityValue */
        return $entityValue->format('Y-m-d H:i:s');
    }
}