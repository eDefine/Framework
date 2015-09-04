<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class Choice
 * @package Edefine\Framework\Form
 */
class Choice extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'name' => $this->getFullName()
        ]);


        $optionsParts = [];
        foreach ($options as $key => $value) {
            $optionsParts[] = sprintf('%s="%s"', $key, $value);
        }

        $result = sprintf('<select %s>', implode(' ', $optionsParts));

        if (!isset($this->options['choices'])) {
            throw new \RuntimeException('Choices for choice input are not set');
        }

        foreach ($this->options['choices'] as $value => $name) {
            if ($this->getValue() == $value) {
                $selectedString = 'selected="selected"';
            } else {
                $selectedString = '';
            }

            $result .= sprintf('<option value="%s" %s>%s</option>', htmlspecialchars($value), $selectedString, $name);
        }

        $result .= '</select>';

        return $result;
    }
}