<?php

namespace Fixture;

use Edefine\Framework\Fixture\AbstractFixture;
use Entity\Message;
use Entity\User;

class MessageFixture extends  AbstractFixture
{
    const MESSAGES_TO_CREATE = 100;

    public function getOrder()
    {
        return 4;
    }

    public function load()
    {
        /** @var \Edefine\Framework\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('manager');

        $users = $this->getContainer()->get('userRepository')->findAll();

        for ($i = 1; $i <= self::MESSAGES_TO_CREATE; $i++) {
            $message = $this->createMessage(
                $this->getRandomDate(),
                $this->getRandomElement($users),
                $this->getRandomElement($users),
                $this->getRandomString(rand(10, 100)),
                $this->getRandomString(rand(10, 1000)),
                $this->getRandomBoolean()
            );
            $manager->save($message);
        }
    }

    private function createMessage(\DateTime $date, User $sender, User $recipient, $title, $content, $new)
    {
        $message = new Message();

        $message
            ->setDate($date)
            ->setSenderId($sender->getId())
            ->setRecipientId($recipient->getId())
            ->setTitle($title)
            ->setContent($content)
            ->setNew($new);

        return $message;
    }

    private function getRandomDate()
    {
        $date = new \DateTime(sprintf('-%d days', rand(0, 1000)));

        $date->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

        return $date;
    }

    private function getRandomString($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz ';

        $result = '';
        for ($i = 1; $i <= $length; $i++) {
            $result .= $chars{rand(0, strlen($chars) - 1)};
        }

        return $result;
    }
}