<?php

namespace App\Chanels\Messages;

class FirebaseSMSMessage
{
    private $title;
    private $message;

    public function setData($title, $message) 
    {
        $this->title = $title;
        $this->message = $message;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMessage()
    {
        return $this->message;
    }

}