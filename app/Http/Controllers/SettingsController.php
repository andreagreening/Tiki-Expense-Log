<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Team;
use Invite;
use User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChanged;
use App\Mail\AccountDeleted;
use Log;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
    	return view('settings.user')
            ->with('user', $user);
    }

    public function changeName(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|string|max:50'
            ]);
        // changes UserName
        
        $user = Auth::user();
        $user->name = $request->userName;
        $user->save();

        return redirect('settings')
            ->with('success', 'Your user name has been updated.');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'newPassword' => 'required',
            'confirmNewPassword' => 'required|same:newPassword'
            ]);

        $user = Auth::user();

        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;

        if(Hash::check($currentPassword, $user->password))
        {
          $user->fill([
            'password' => Hash::make($newPassword)])->save();
        }

        Mail::to($user->email)->send(new PasswordChanged($user));

        return redirect('settings')
            ->with('success', 'Your password has been changed.');

    }

    public function changeEmail(Request $request) 
    {
         $this->validate($request, [
            'email' => 'required|email'
            ]);

         $user = Auth::user();
         $user->email = $request->email;
         $user->save();

         return redirect('settings')
            ->with('success', 'Your email has been changed.');

    }

    public function deleteAccount()
    {
        $user = Auth::user();

        Mail::to($user->email)->send(new AccountDeleted($user));
        Log::info('User Chose to Delete Account->ID: ' . $user->id);

        $user->deleteUserAndAllData();

        return redirect('/');

    }

    public function team()
    {
        $team = Auth::user()->team;
        $users = $team->users()
         ->where('id', '!=', Auth::user()->id)
         ->get();
        
        $onTeams = Auth::user()->teams;
        $invitedUser = Auth::user();
        $invitesSent = Auth::user()->invites;
        $invitesRecieved = Invite::where('email', Auth::user()->email)->get();

    	return view('settings.team')
            ->with('users', $users)
            ->with('team', $team)
            ->with('invitesRecieved', $invitesRecieved)
            ->with('onTeams', $onTeams)
            ->with('invitesSent', $invitesSent);
    }


}
