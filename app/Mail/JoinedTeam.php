<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Invite;


class JoinedTeam extends Mailable
{
    use Queueable, SerializesModels;

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
        $url = route('settings.team');
        $userName = $this->invite->team->owner->name;
        $newTeammate = $this->invite->email;
        $subject = "Hey $userName, $newTeammate joined your team!";
        
        return $this->markdown('mail.joinedYourTeam')
            ->with($subject)
            ->with('userName', $userName)
            ->with('newTeammate', $newTeammate)
            ->with('url', $url);

    }
}
