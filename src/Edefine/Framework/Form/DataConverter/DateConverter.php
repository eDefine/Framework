<?php

namespace Edefine\Framework\Form\DataConverter;

/**
 * Class DateConverter
 * @package Edefine\Framework\Form\DataConverter
 */
class DateConverter implements ConverterInterface
{
    /**
     * @param $formValue
     * @return \DateTime
     */
    public function convertToEntity($formValue)
    {
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
        return $entityValue->format('Y-m-d');
    }
}