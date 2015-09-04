<?php

namespace Edefine\Framework\Validator;

class NotNullValidator extends AbstractValidator
{
    public function validate($object)
    {
        if ($object == null) {
            $this->addError('This value cannot be null.');
            return false;
        }

        return true;
    }
}