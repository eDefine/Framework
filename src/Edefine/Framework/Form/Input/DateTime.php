<?php

namespace Edefine\Framework\Form\Input;

use Edefine\Framework\Form\DataConverter\DateTimeConverter;

/**
 * Class DateTime
 * @package Edefine\Framework\Form
 */
class DateTime extends Text
{
    /**
     * @return DateTimeConverter
     */
    public function getDataConverter()
    {
        return new DateTimeConverter();
    }
}