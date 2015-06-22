<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\Date;
use Edefine\Framework\Form\Input\TextArea;
use Edefine\Framework\Form\Input\Text;

class TransactionForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new Text('name'))
            ->addInput(new TextArea('description'))
            ->addInput(new Date('transactionDate'))
            ->addInput(new Text('value'));
    }
}