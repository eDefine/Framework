<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\Text;

class ProductForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new Text('name'))
            ->addInput(new Text('weight'))
            ->addInput(new Text('calories'));
    }
}