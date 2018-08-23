<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use User;

class PasswordChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('settings');
        $userName = $this->user->name;
        $subject = "Hey $userName, your password on Tiki Log has been changed!";

        return $this->markdown('mail.passwordChanged')
            ->subject($subject)
            ->with('userName', $userName)
            ->with('url', $url);
    }
}
