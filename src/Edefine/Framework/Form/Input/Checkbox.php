<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Checkbox
 * @package Edefine\Framework\Form
 */
class Checkbox extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'type' => 'checkbox',
            'name' => $this->getFullName(),
            'value' => '1',
        ]);

        if ($this->getValue()) {
            $options['checked'] = 'checked';
        }

        return $this->getSimpleInput($options);
    }
}