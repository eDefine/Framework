<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Password
 * @package Edefine\Framework\Form
 */
class Password extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'type' => 'password',
            'name' => $this->getFullName(),
            'value' => htmlspecialchars($this->getValue()),
            'placeholder' => $this->getName()
        ]);

        return $this->getSimpleInput($options);
    }
}