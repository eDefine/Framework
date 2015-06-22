<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\Choice;
use Edefine\Framework\Form\Input\Text;

class CategoryForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new Text('name'))
            ->addInput(new Choice('parentId', ['choices' => $this->options['categories']]));
    }
}