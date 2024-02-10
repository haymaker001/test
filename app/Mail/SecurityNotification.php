<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\SecurityNotification;

class SecurityNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function build()
    {
        $notification = SecurityNotification::where('id', 5);
        return $this->view('emails.security-notification', compact('notification'));
    }
}