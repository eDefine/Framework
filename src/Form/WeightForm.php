<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\DateTime;
use Edefine\Framework\Form\Input\Text;

class WeightForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new DateTime('date'))
            ->addInput(new Text('value'))
            ->addInput(new Text('info'));
    }
}