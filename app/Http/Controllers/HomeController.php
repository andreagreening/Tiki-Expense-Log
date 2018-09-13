<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Transaction;
use Category;
use Invite;
use Carbon\Carbon;
use User;
use Team;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()){
            return redirect(route('dashboard', Auth::user()->team->id));
        }
      return view('welcome');
  }

  public function demo()
  {
    if (Auth::check()){
            return redirect(route('dashboard', Auth::user()->team->id));
        }
        // Create demo user. Randomized email. 
        // observer creates demoUser transactions. 
        // delete demo account after 1 hour in Observer.

        $user = new User;
        $user->name = 'Demo';
        $user->demo = 1;
        $user->email = str_random(5).'@example.com';
        $user->password = Hash::make(str_random(8));
        $user->save();

        $team = $user->team;
        Auth::loginUsingId($user->id);
        return redirect(route('dashboard', $team->id));

  }


  public function registerDemo()
  {
    // Logs DemoUser out and redirects to register. 
    return redirect('register')->with(Auth::logout());
  }

  // public function twilio(Request $request){
  //   if(!$request->has('SmsMessageSid')){
  //           $caller = $request->get('From');
  //           Log::debug($caller.' has attempted to call.');
  //       //     // Eventually have an audio message that informs the caller to text me!
  //           die();
  //       }
  //       $smsBody = "Add $400.00 Vet Bill to Pet Expenses";
  //       // TODO::1)Associate team with phone number  2)Parse numerics into transaction amount 3)Find Category 4)find description
  // }

  public function test()
  {
     $user = Auth::user();
     // dd(Auth::user()->team->users());
      // if(!Auth::user()->isOnTeam(25))
      //   {
         
      //       return redirect(route('dashboard', Auth::user()->team))
      //               ->with('error', "You do not have permission to view that team's dashboard.");
      //   }    
  }







}
