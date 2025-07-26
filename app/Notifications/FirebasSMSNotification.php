<?php

namespace App\Notifications;

use App\Chanels\Messages\FirebaseSMSMessage;
use App\Chanels\FirebaseSMSChanel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FirebasSMSNotification extends Notification
{
    use Queueable;

    private $title;
    private $message;


    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

   
    public function via($notifiable)
    {
        return [FirebaseSMSChanel::class];
    }

  
    public function toFirebaseSMS()
    {
       return (new FirebaseSMSMessage())->setData($this->title, $this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
