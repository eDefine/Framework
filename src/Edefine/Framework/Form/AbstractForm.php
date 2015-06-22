<?php

namespace Edefine\Framework\Form;

use Edefine\Framework\Form\Input\AbstractInput;
use Edefine\Framework\Http\Request;

/**
 * Class AbstractForm
 * @package Edefine\Framework\Form
 */
abstract class AbstractForm
{
    protected $options;
    private $name;
    private $object;
    /** @var AbstractInput[] */
    private $inputs = [];

    protected abstract function build();

    /**
     * @param $name
     * @param array $options
     */
    public function __construct($name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;

        $this->build();
    }

    /**
     * @param $data
     */
    public function bindData($data)
    {
        $this->object = $data;

        foreach ($this->inputs as $name => $input) {
            $getter = 'get' . ucfirst($name);
            $dataConverter = $input->getDataConverter();
            $input->setValue($dataConverter->convertToForm($data->$getter()));
        }
    }

    /**
     * @param Request $request
     */
    public function bindRequest(Request $request)
    {
        $data = $request->getParam($this->name);
        $files = $request->getFiles($this->name);

        foreach ($this->inputs as $name => $input) {
            $setter = 'set' . ucfirst($name);
            $dataConverter = $input->getDataConverter();
            if (isset($data[$name])) {
                $this->object->$setter($dataConverter->convertToEntity($data[$name]));
            } elseif (isset($files[$name])) {
                $this->object->$setter($dataConverter->convertToEntity($files[$name]));
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws \RuntimeException
     */
    public function get($name)
    {
        if (!isset($this->inputs[$name])) {
            throw new \RuntimeException(sprintf('Input %s is not set', $name));
        }

        return $this->inputs[$name];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param AbstractInput $input
     * @return $this
     */
    protected function addInput(AbstractInput $input)
    {
        $input->setForm($this);
        $this->inputs[$input->getName()] = $input;

        return $this;
    }
}