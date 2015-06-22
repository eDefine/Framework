<?php

namespace Form;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\File;
use Edefine\Framework\Form\Input\Hidden;

class TransactionImportForm extends AbstractForm
{
    protected function build()
    {
        $this
            ->addInput(new File('file'))
            ->addInput(new Hidden('hidden'));
    }
}