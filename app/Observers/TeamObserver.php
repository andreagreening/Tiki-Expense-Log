<?php 

namespace App\Observers;

use Log;
use Team;
use Auth;

class TeamObserver
{
 // REGISTER this in AppServiceProvider

	public function created(Team $team)
	{
		// Log::debug($team->toArray()); 
		// Add the owner to her own team.
		// Moved this function to the UserObserver
		// $team->users()->attach(Auth::user());
	}



}



