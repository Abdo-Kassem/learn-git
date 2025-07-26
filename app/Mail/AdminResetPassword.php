<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $data = [];

    public function __construct($data=[])
    {
        $this->data = $data;
    }

    
    public function build()
    {
        return $this->markdown('Admin.emails.admin_reset_password')
        ->subject('Admin Reset Password')
        ->with('data' , $this->data);
    }
}
