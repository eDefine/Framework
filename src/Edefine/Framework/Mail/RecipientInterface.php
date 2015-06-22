<?php

namespace Edefine\Framework\Mail;

interface RecipientInterface
{
    public function getEmail();
    public function getName();
}