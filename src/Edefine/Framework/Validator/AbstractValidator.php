<?php

namespace Edefine\Framework\Validator;

/**
 * Class AbstractValidator
 * @package Edefine\Framework\Validator
 */
abstract class AbstractValidator
{
    private $errors = [];

    /**
     * @param $object
     * @return bool
     */
    abstract public function validate($object);

    /**
     * @param null $field
     * @return array
     */
    public function getErrors($field = null)
    {
        if ($field) {
            if (isset($this->errors[$field])) {
                return $this->errors[$field];
            } else {
                return [];
            }
        } else {
            return $this->errors;
        }
    }

    /**
     * @param null $field
     * @return bool
     */
    public function hasErrors($field = null)
    {
        if ($field) {
            return isset($this->errors[$field]) && $this->errors[$field];
        } else {
            return !!$this->errors;
        }
    }

    /**
     * @param $message
     * @param null $field
     * @return $this
     */
    protected function addError($message, $field = null)
    {
        if ($field) {
            $this->errors[$field][] = $message;
        } else {
            $this->errors[] = $message;
        }

        return $this;
    }
}