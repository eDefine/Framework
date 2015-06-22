<?php

namespace Edefine\Framework\Form\Input;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\DataConverter\SimpleConverter;

/**
 * Class AbstractInput
 * @package Edefine\Framework\Form\Input
 */
abstract class AbstractInput
{
    private $name;
    protected $options;
    private $value;
    private $form;
    private $dataConverter;

    abstract public function getField(array $options);

    /**
     * @param $name
     * @param array $options
     */
    public function __construct($name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param AbstractForm $form
     * @return $this
     */
    public function setForm(AbstractForm $form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @param array $options
     * @return string
     */
    protected function getSimpleInput(array $options = [])
    {
        $optionsParts = [];
        foreach ($options as $key => $value) {
            $optionsParts[] = sprintf('%s="%s"', $key, $value);
        }

        return sprintf('<input %s />', implode(' ', $optionsParts));
    }

    /**
     * @return SimpleConverter
     */
    public function getDataConverter()
    {
        if (!$this->dataConverter) {
            $this->dataConverter = new SimpleConverter();
        }

        return $this->dataConverter;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        if ($this->form) {
            return sprintf('%s[%s]', $this->form->getName(), $this->getName());
        } else {
            return $this->getName();
        }
    }
}