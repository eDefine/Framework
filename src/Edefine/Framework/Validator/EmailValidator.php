<?php

namespace Edefine\Framework\Validator;

class EmailValidator extends AbstractValidator
{
    public function validate($object)
    {
        if (!filter_var($object, FILTER_VALIDATE_EMAIL)) {
            $this->addError('This value is not a valid email address.');
            return false;
        }

        return true;
    }
}