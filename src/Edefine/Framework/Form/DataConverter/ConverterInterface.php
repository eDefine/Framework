<?php

namespace Edefine\Framework\Form\DataConverter;

/**
 * Interface ConverterInterface
 * @package Edefine\Framework\Form\DataConverter
 */
interface ConverterInterface
{
    /**
     * @param $formValue
     * @return mixed
     */
    public function convertToEntity($formValue);

    /**
     * @param $entityValue
     * @return mixed
     */
    public function convertToForm($entityValue);
}