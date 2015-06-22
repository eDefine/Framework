<?php

namespace Edefine\Framework\View\Extension;

use Edefine\Framework\Form\AbstractForm;
use Edefine\Framework\Form\Input\AbstractInput;

/**
 * Class FormExtension
 * @package Edefine\Framework\View\Extension
 */
class FormExtension extends \Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'form';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('form_input', [$this, 'getInput'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param AbstractInput $input
     * @param array $options
     * @return string
     */
    public function getInput(AbstractInput $input, array $options = [])
    {
        return $input->getField($options);
    }
}