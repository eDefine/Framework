<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Hidden
 * @package Edefine\Framework\Form
 */
class Hidden extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'type' => 'hidden',
            'name' => $this->getFullName(),
            'value' => htmlspecialchars($this->getValue())
        ]);

        return $this->getSimpleInput($options);
    }
}