<?php

namespace Edefine\Framework\Form\DataConverter;

/**
 * Class SimpleConverter
 * @package Edefine\Framework\Form\DataConverter
 */
class SimpleConverter implements ConverterInterface
{
    /**
     * @param $formValue
     * @return mixed
     */
    public function convertToEntity($formValue)
    {
        return $formValue;
    }

    /**
     * @param $entityValue
     * @return mixed
     */
    public function convertToForm($entityValue)
    {
        return $entityValue;
    }
}