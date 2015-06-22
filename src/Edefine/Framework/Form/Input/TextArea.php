<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Text
 * @package Edefine\Framework\Form
 */
class TextArea extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'name' => $this->getFullName(),
            'placeholder' => $this->getName()
        ]);

        $optionsParts = [];
        foreach ($options as $key => $value) {
            $optionsParts[] = sprintf('%s="%s"', $key, $value);
        }

        return sprintf('<textarea %s>%s</textarea>', implode(' ', $optionsParts), $this->getValue());
    }
}