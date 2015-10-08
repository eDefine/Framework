<?php

namespace Edefine\Framework\Form;

use Edefine\Framework\Form\Input\AbstractInput;
use Edefine\Framework\Http\Request;
use Edefine\Framework\Validator\ValidValidator;

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

    /** @var Request */
    private $request;

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
        $this->request = $request;

        $data = $request->getParam($this->name);
        $files = $request->getFiles($this->name);

        foreach ($this->inputs as $name => $input) {
            $setter = 'set' . ucfirst($name);
            $dataConverter = $input->getDataConverter();
            if (isset($data[$name])) {
                $this->object->$setter($dataConverter->convertToEntity($data[$name]));
                $input->setValue($data[$name]);
            } elseif (isset($files[$name])) {
                $this->object->$setter($dataConverter->convertToEntity($files[$name]));
                $input->setValue($files[$name]);
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

    /**
     * @return bool
     */
    public function isSent()
    {
        if (!$this->request) {
            return false;
        }

        return $this->request->hasParam($this->name) || $this->request->hasFiles($this->name);
    }

    protected function getValidator()
    {
        return new ValidValidator();
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->request->getParam($this->name)) {
            return $this->getValidator()->validate($this->object);
        } else {
            return false;
        }
    }

    /**
     * @param null $field
     * @return array
     */
    public function getErrors($field = null)
    {
        if ($this->isSent() && $this->request->getParam($this->name)) {
            $validator = $this->getValidator();
            $validator->validate($this->object);

            return $validator->getErrors($field);
        } else {
            return [];
        }
    }

    /**
     * @param null $field
     * @return bool
     */
    public function hasErrors($field = null)
    {
        return !!$this->getErrors($field);
    }
}