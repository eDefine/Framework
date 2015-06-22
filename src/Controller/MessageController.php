<?php

namespace Controller;

use Form\MessageForm;

class MessageController extends AbstractController
{
    public function indexAction()
    {
        if (!$this->getUser()) {
            $this->getContainer()->get('flashBag')->add('error', 'You must be logged to view this section.');
            return $this->redirect($this->getPath('home', 'index'));
        }

        $messages = $this->getContainer()->get('messageRepository')->getAllForUser($this->getUser());

        return $this->renderView([
            'messages' => $messages
        ]);
    }

    public function viewAction()
    {
        $message = $this->getContainer()->get('messageRepository')->findOneById($this->getParam('id'));

        if ($message->getNew()) {
            $message->setNew(false);

            $this->getContainer()->get('manager')->save($message);
        }

        return $this->renderView([
            'message' => $message
        ]);
    }

    public function writeAction()
    {
        $recipient = $this->getContainer()->get('userRepository')->findOneById($this->getParam('id'));

        $message = $this->getContainer()->get('messageSender')->create($this->getUser(), $recipient);
        $messageForm = new MessageForm('message');

        $messageForm->bindData($message);

        if ($this->getParam('message')) {
            $messageForm->bindRequest($this->getRequest());

            $this->getContainer()->get('messageSender')->send($message);

            return $this->redirect($this->getPath('message', 'index'));
        }

        return $this->renderView([
            'recipient' => $recipient,
            'messageForm' => $messageForm
        ]);
    }
}