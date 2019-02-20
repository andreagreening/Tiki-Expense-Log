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
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request, Team $team)
 {
 	 if (!Auth::check()){
            return redirect(route('login'))
                ->with('error', 'You must be logged in!');
        }
    // dd($team);    

// TODO: VERIFY TEAM EXISTS. 
        // if(!$team)
        // {
        // 	return redirect(route('dashboard', Auth::user()->team))
        //             ->with('error', "That team does not exist.");
        // }
// TODO::This is running into an issue when there are not other users, so i could also check if it is a team belonging to this user....needs to cover both situations.  
        $teamId = $team->id;
         if(!Auth::user()->isOnTeam($teamId))
        {
            return redirect(route('dashboard', Auth::user()->team))
                    ->with('error', "You do not have permission to view that team's dashboard.");
        }    

        $user = Auth::user();
       
        $categories = $team->categories()
            ->noSubCats() // our new Scope in the Model
            ->orderBy('title', 'desc')->get();
        //  Categories By Id for Chart Labels
        $enddate = New Carbon($request->enddate);
        $startdate = New Carbon($request->startdate);
        if($enddate->lessThan($startdate))
        {
            return redirect(route('dashboard', $team))
                ->with('error', 'Start date must be before end date.');
        }
        $transawctions = $team->transactions()->where('date', '=', $startdate)->get();
        $transactions = $team->transactions()
            ->filter($request->all())
            ->orderBy('id', 'desc');
         // dd($transactions);   
        // dd($transactions->get());
        $transactionSum = $transactions->sum('amount');
        $transactions = $transactions->paginate(10); 
       $teamsList = Auth::user()->teams->where('user_id', '!=', Auth::user()->id); 
        return view('dashboard.view')
            ->with('categories', $categories)
            ->with('transactions', $transactions)
            ->with('transactionSum', $transactionSum)
            ->with('teamsList', $teamsList)
            ->with('team', $team);
    }

}
