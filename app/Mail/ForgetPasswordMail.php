<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_name;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $link)
    {
        //
        $this->user_name = $user;
        // $this->link='http://127.0.0.1:8000/reset-password/'.$link;
        $this->link = asset('') . 'reset-password/' . $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password reset ')->view('mail.forget_password_mail');
    }
}
