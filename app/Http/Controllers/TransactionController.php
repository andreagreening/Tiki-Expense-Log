<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Transaction;
use Category;
use Team;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function create()
    {
    	if (!Auth::check()){
			return redirect(route('login'))
				->with('error', 'You must be logged in!');
		}

    	return view('transactions.create');
    }

    public function store(Request $request, Team $team)
    {
    	$this->validate($request, [
    		'description' => 'required|max:255',
    		'amount' => 'required|numeric|max:10000000',	
            'date' => 'date',
    		]);

    	$transaction = new Transaction;
    	$transaction->user_id = Auth::user()->id;
    	$transaction->description = $request->description;
    	$transaction->amount = $request->amount;
        $transaction->date = Carbon::parse($request->date);
    	$transaction->category_id = $request->category_id;
        $transaction->team_id = $team->id;
    	$transaction->save();

    	return redirect(route('dashboard', $team))
    		->with('success', 'Your transaction has been created');
     }

     public function edit(Transaction $transaction)
     {
        if (!Auth::check()){
            return redirect(route('login'))
                ->with('error', 'You must be logged in!');
        }

// Verify the user is on the team associated with this transaction.
         $teamId = $transaction->team_id;
        
        if(!Auth::user()->isOnTeam($teamId))
        {
            return redirect(route('dashboard', Auth::user()->team))
                    ->with('error', 'You do not have permission to edit that transaction.');
        }    

        $userId = Auth::user()->id;
           
        $categories = Category::where('team_id', '=', $teamId)->noSubCats()->orderBy('title', 'desc')->get();

        return view('transactions.edit')
            ->with('categories', $categories)
            ->with('transaction', $transaction);
     }

     public function update(Request $request, Transaction $transaction)
     {
       $teamId = $transaction->team_id;
        
        if(!Auth::user()->isOnTeam($teamId))
        {
            return redirect(route('dashboard', Auth::user()->team))
                    ->with('error', 'You do not have permission to edit that transaction.');
        }  
          
        $this->validate($request, [
            'description' => 'required|max:255',
            'amount' => 'required|numeric|max:10000000', 
            'date' => 'date',

            ]);

        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->date = Carbon::parse($request->date);
        $transaction->category_id = $request->category_id;

        $transaction->save();

        return redirect(route('dashboard', $transaction->team_id))
            ->with('success', 'Your transaction has been updated.');
     }

     public function confirmDelete(Transaction $transaction)
     {
         $teamId = $transaction->team_id;
        
        if(!Auth::user()->isOnTeam($teamId))
        {
            return redirect(route('dashboard', Auth::user()->team))
                    ->with('error', 'You do not have permission to delete that transaction.');
        }    

       return view('transactions.confirmDelete')
            ->with('transaction', $transaction);
     }

     public function delete(Transaction $transaction)
     {
       $teamId = $transaction->team_id;
        
        if(!Auth::user()->isOnTeam($teamId))
        {
            return redirect(route('dashboard', Auth::user()->team))
                    ->with('error', 'You do not have permission to delete that transaction.');
        }    

     	$transaction->delete();

        return redirect('/home')
            ->with('success', 'That transaction has been deleted.');
     }

    















}


