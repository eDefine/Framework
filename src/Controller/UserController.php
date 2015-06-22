<?php

namespace Controller;

class UserController extends AbstractController
{
    public function indexAction()
    {
        $users = $this->getContainer()->get('userRepository')->findAll();

        return $this->renderView([
            'users' => $users
        ]);
    }
}