<?php

namespace Edefine\Framework\Form\Input;

/**
 * Class File
 * @package Edefine\Framework\Form
 */
class File extends AbstractInput
{
    /**
     * @param array $options
     * @return string
     */
    public function getField(array $options = [])
    {
        $options = array_merge($options, [
            'type' => 'file',
            'name' => $this->getFullName()
        ]);

        return $this->getSimpleInput($options);
    }
}