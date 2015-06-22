<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Message extends AbstractEntity
{
    private $date;
    private $senderId;
    private $recipientId;
    private $title;
    private $content;
    private $new;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getRecipientId()
    {
        return $this->recipientId;
    }

    public function setRecipientId($recipientId)
    {
        $this->recipientId = $recipientId;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getNew()
    {
        return $this->new;
    }

    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    public function getTableName()
    {
        return 'message';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'date',
            'senderId',
            'recipientId',
            'title',
            'content',
            'new'
        ];
    }

    public function getDateTimeFields()
    {
        return [
            'date'
        ];
    }
}