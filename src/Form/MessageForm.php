<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\Text;
use Edefine\Framework\Form\Input\TextArea;

class MessageForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new Text('title'))
            ->addInput(new TextArea('content'));
    }
}