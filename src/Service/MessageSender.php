<?php

namespace Service;

use Edefine\Framework\Mail\Mail;
use Edefine\Framework\Mail\Mailer;
use Edefine\Framework\ORM\EntityManager;
use Entity\Message;
use Entity\User;
use Repository\UserRepository;

class MessageSender
{
    private $manager;
    private $userRepository;
    private $mailer;

    public function __construct(EntityManager $manager, UserRepository $userRepository, Mailer $mailer)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    public function create(User $sender, User $recipient)
    {
        $message = new Message();

        $message
            ->setSenderId($sender->getId())
            ->setRecipientId($recipient->getId())
            ->setNew(true);

        return $message;
    }

    public function send(Message $message)
    {
        $message->setDate(new \DateTime());

        $this->manager->save($message);

        $recipient = $this->userRepository->findOneById($message->getRecipientId());
        $sender = $this->userRepository->findOneById($message->getSenderId());

        $mail = new Mail();
        $mail->addRecipient($recipient);
        $mail->setTitle(sprintf('Hello, %s! You have a new message!', $recipient->getFullName()));
        $mail->setBody(sprintf('You have a new message <b>%s</b> from <i>%s</i>', $message->getTitle(), $sender->getFullName()));

        $this->mailer->send($mail);
    }
}