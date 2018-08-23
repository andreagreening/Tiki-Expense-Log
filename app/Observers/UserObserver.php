<?php 

namespace App\Observers;

use Log;
use Team;
use Auth;
use User;
use Invite;
use Category;
use Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\JoinedTiki;


class UserObserver
{
 // REGISTER this in AppServiceProvider

	public function created(User $user)
	{
		// When a new User is registered, we create a new team for the User. We also create the default categories for the User. Then, it is determined if this is a demo user, and creates demo transactions accordingly. The demo user is later deleted along with all transactions and categories. This destruction occurs in the User model. 
		
	 	$team = New Team;
	 	$team->user_id = $user->id;
	 	$team->save();

	 	$team->users()->attach($user);

		Log::info('New User Registered.');
		Log::info('New team created for user', $team->toArray());
		//	Create new Categories for this User
		$defaultCategories = Category::getDefaultCategories();
		foreach($defaultCategories as $defaultCategory){
			$category = new Category;
			$category->user_id = $user->id;
			$category->team_id = $team->id;
			$category->title = $defaultCategory;
			$category->save();
		}

		// Create default Subcategories
		$defaultSubCategories = Category::getDefaultSubCategories();
		foreach($defaultSubCategories as $parentName => $subcats){
			foreach($subcats as $subcat){
				$category = new Category;
				$category->user_id = $user->id;
				$category->team_id = $team->id;
				$category->title = $subcat;
				$parentCategory = Category::where('user_id', $user->id)->where('title', $parentName)->first();
				$category->pid = $parentCategory->id;
				$category->save();
			}
		}

		if(!$user->demo)
		{
			Mail::to($user->email)->send(new JoinedTiki($user));
		}

		if($user->demo)
		{
			$this->createDemoTransactions($user);
		}
	}

	public function createDemoTransactions($user)
	{
		// This creates the transactions for the demo account. 
		$demoTransactions = Transaction::getDemoTransactions();
		foreach($demoTransactions as $demoTransaction)
		{
			$transaction = new Transaction;
			$transaction->user_id = $user->id;
			$transaction->team_id = $user->team->id;
			$transaction->date = Carbon::now()->subDays($demoTransaction['daysAgo']);
			
			$transaction->description = $demoTransaction['description'];
			$transaction->amount = $demoTransaction['amount'];
			$category = Category::where('user_id', $user->id)->where('title', $demoTransaction['categoryTitle'])->first();
			$transaction->category_id = $category->id;
			$transaction->save();
		}
	}

	// public function deleteDemoUser()
	// {
		// TODO::Find all demo users older than one hour.
		// Delete all transactions for demo user.
		// Delete all categories for demo user.
		// Delete team for demo user.
		// Delete Demo User. 
	// }


}



