<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Text
 * @package Edefine\Framework\Form
 */
class Text extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'name' => $this->getFullName(),
            'value' => $this->getValue(),
            'placeholder' => $this->getName()
        ]);

        return $this->getSimpleInput($options);
    }
}