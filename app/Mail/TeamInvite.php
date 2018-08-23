<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Invite;


class TeamInvite extends Mailable
{
    use Queueable, SerializesModels;
    protected $invite;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('team.acceptInvite', $this->invite->token);
        $userName = $this->invite->team->owner->name;
        $subject = "You have been invited to join $userName's Team on Tiki Log!";

        return $this->markdown('mail.teamInvite')
            ->subject($subject)
            ->with('url', $url);
    }
}
