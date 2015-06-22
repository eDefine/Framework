<?php

namespace Edefine\Framework\Form\Input;

use Edefine\Framework\Form\DataConverter\DateConverter;

/**
 * Class Date
 * @package Edefine\Framework\Form
 */
class Date extends Text
{
    /**
     * @return DateConverter
     */
    public function getDataConverter()
    {
        return new DateConverter();
    }
}