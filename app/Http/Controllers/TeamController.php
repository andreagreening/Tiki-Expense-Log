<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Team;
use Auth;
use Log;
use User;
use Invite;
use Transaction;
use Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamInvite;
use App\Mail\JoinedTeam;



class TeamController extends Controller
{

public function __construct()
{
	$this->middleware('auth');
}
	
 public function create()
 {
 	if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }
 }

 public function changeName(Team $team, Request $request)
 {
 	if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }
    if(!Auth::user()->team->owner) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }

            $this->validate($request, [
        		'teamName' => 'required|max:255'
            	]);

            $team->name = $request->teamName;
            $team->save();

            return redirect(route('settings.team'))
            ->with('success', 'Your team name has been changed.');

 }

 public function sendInvite()
 {
 	return view('teams.sendInvite');
 }

 public function sent(Request $request)
 {
 	if(!Auth::check()) {
        return redirect('/login')
        ->with('error', 'You must be logged in!');
    }

 	$this->validate($request, [
			'email' => 'required|email',
			]);

 	$team = Auth::user()->team;
 	$existingUser = User::where('email', $request->email)->first();
 	$existingInvite = Invite::where('email', $request->email)->where('team_id', $team->id)->first();

 	if ($existingUser) {
 		if(!$team->users->contains($existingUser->id))
 		{
 			// TODO: Send Email
 			// $team->users()->attach($existingUser);
 			// TODO redirect user to prevent invite from being created. 
 		}
 		// TODO: email this user to let them know they've been added.
 	}

 	if ($existingInvite) {
 		// TODO: resend Invite, warn previously invited.
 		return redirect()->back()->with('info', "You have already invited that user, we resent the invitation.");
 	}

 	$invite = New Invite;
 	$invite->user_id = Auth::user()->id;
 	$invite->team_id = $team->id;
 	$invite->email = $request->email;
 	$invite->token = str_random(12);
 	$invite->save();

 	Mail::to($invite->email)->send(new TeamInvite($invite));

 	return redirect(route('settings.team'))
 		->with('success', 'Your invite has been sent!');
 }

 public function acceptInvite($token)
{
	if(!Auth::check()) {
        return redirect('/login')
            ->with('error', 'To accept this invite, you must login or sign up.');
            }

	$invite = Invite::where('token', $token)->first();

    // if($invite->email != Auth::user()->email)
    // {
    //     return redirect(route('home'))
    //     ->with('error', 'The invitation to join this team does not match your credentials.');
    // }

	if(!$invite)
	{
		return redirect(route('home'))
			->with('error', 'Sorry, that link is no longer valid.');
	}

	$team = $invite->team;

	if($team->users->contains(Auth::user()->id))
	{
        return redirect('/')
            ->with('warning', 'You are already on that team.');
    }
        
	   $team->users()->attach(Auth::user()->id);
 		Mail::to($invite->team->owner->email)->send(new JoinedTeam($invite));
 		Log::info('User '.$invite->email.' has accepted an invitation to team '.$team->id);	
 		$invite->delete();
 		
 		return redirect(route('settings.team'))
 			->with('success', 'You have joined that team!');
}

public function remove(User $user)
{
// CHECKED ROUTE:: Won't allow me to change anything, however, it does give me a success message claiming I removed a user, even though I hadn't! 

	if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            } 
            
    $team = Auth::user()->team;
    $team->users()->detach($user->id);


 		return redirect(route('settings.team'))
 			->with('success', 'You have removed that user.');

}

public function leave($id)
{
// CHECKED ROUTE:: Is not allowing fuckery due to the $user being set to Auth, is this enough or should I add some sort of extra permissions?

	if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }
	$team = Team::find($id);
	$user = Auth::user();
	$team->users()->detach($user->id);
	return redirect(route('settings.team'))
 			->with('success', 'You have left the team.');
}

public function deleteInvite($id)
{
// CHECKED AND SECURE 

	$invite = Invite::find($id);
	if($invite->user_id != Auth::user()->id){
		return redirect(route('dashboard', Auth::user()->team))
	        		->with('error', 'You cannot edit that invitation.');
	}

	$invite->delete();

	return redirect(route('settings.team'))
 			->with('success', 'You have cancelled the invitation.');
} 



}
