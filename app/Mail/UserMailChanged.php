<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMailChanged extends Mailable
{
    use Queueable, SerializesModels;
    public $user ;
    public function __construct(User $user)
    {
        $this->user = $user ;
    }
    public function build()
    {
        return $this->text('emails.confirm')->subject('PLease confirm your email');
    }
}
