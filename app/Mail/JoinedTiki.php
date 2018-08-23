<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use User;

class JoinedTiki extends Mailable
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
        $url = route('login');
        $userName = $this->user->name;
        $subject = "Thank you for joining Tiki Log!";

        return $this->markdown('mail.joinedTiki')
            ->with($subject)
            ->with('userName', $userName)
            ->with('url', $url);
    }
}
