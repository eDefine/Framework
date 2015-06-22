<?php

namespace Edefine\Framework\Mail;

class Recipient implements RecipientInterface
{
    private $email;
    private $name;

    public function __construct($email, $name = null)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }
}