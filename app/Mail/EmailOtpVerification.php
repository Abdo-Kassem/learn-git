<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailOtpVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user= $user;
    }

    
    public function build() 
    {
        return $this->view('Admin.emails.send_otp_email')
            ->subject('Your El-marsa verification Code')
            ->with('otp' , $this->user->otp);
    }
}
