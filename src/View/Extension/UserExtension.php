<?php

namespace View\Extension;

use Edefine\Framework\Session\Session;
use Repository\MessageRepository;
use Repository\UserRepository;

class UserExtension extends \Twig_Extension
{
    private $session;
    private $userRepository;
    private $messagesRepository;

    public function __construct(Session $session, UserRepository $userRepository, MessageRepository $messageRepository)
    {
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->messagesRepository = $messageRepository;
    }

    public function getName()
    {
        return 'user';
    }

    public function getGlobals()
    {
        $userId = $this->session->get('userId');

        if ($userId) {
            $user = $this->userRepository->findOneById($userId);
            $newMessages = $this->messagesRepository->getNewForUser($user);
        } else {
            $user = null;
            $newMessages = [];
        }

        return [
            'user' => $user,
            'newMessages' => $newMessages
        ];
    }
}