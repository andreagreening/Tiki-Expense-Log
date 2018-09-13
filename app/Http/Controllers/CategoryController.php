<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Category;
use Transaction;
use Team;
use Carbon\Carbon;

class CategoryController extends Controller
{
	public function store(Request $request, Team $team)
	{
		$this->validate($request, [
			'title' => 'required|max:225',
			]);

		$category = new Category;
		$category->user_id = Auth::user()->id;
		$category->pid = $request->pid;
		$category->title = $request->title;
		$category->team_id = $team->id;
		$category->slug = str_slug($request->title);
		$category->save();

		return redirect(route('dashboard', $team))
			->with('success', 'Your Category has been created.');
	}

	public function edit(Category $category)
	{
		if(!Auth::check()) 
		{
	  		return redirect('/login')
	            ->with('error', 'You must be logged in!');
        }

        $teamId = $category->team_id;
     
        if(!Auth::user()->isOnTeam($teamId))
        {
        	return redirect(route('dashboard', Auth::user()->team))
        		->with('error', 'You do not have permission to edit that category.');
        }    

       $categories = Category::where('team_id', '=', $teamId) ->orderBy('title', 'asc')
       		->noSubCats()
       		->where('id', '!=', $category->id)
       		->get();
	
		return view('categories.edit')
			->with('category', $category)
			->with('categories', $categories);
	}

	public function update(Request $request, Category $category)
	{
		$this->validate($request, [
			'title' => 'required|max:225',
			]);
		$category->title = $request->title;
		$category->pid = $request->pid;
		$category->slug = str_slug($request->title);
		$category->save();

		return redirect(route('home'))
			->with('success', 'Your Category has been updated.');
	}

	public function viewBy(Request $request, Category $category)
	{
		if(!Auth::check()) 
		{
	        return redirect('/login')
	            ->with('error', 'You must be logged in!');
        }

        $teamId = $category->team_id;
        
        if(!Auth::user()->isOnTeam($teamId))
        {
        	return redirect(route('dashboard', Auth::user()->team))
        		->with('error', 'You do not have permission to view that category.');
        }    
     	
        $transactions = Transaction::whereIn('category_id', $category->getSubCatIds($category->id))
    		->filter($request->all())
    		->orderBy('date', 'desc')
    		->get();

        $transactionSum = $transactions->sum('amount');

		$cats = Category::whereIn('id', $category->getSubCatIds($category->id))
        		->orderBy('title', 'desc')
        		->get();
       
		return view('categories.viewBy')
			->with('transactions', $transactions)
			->with('transactionSum', $transactionSum)
			->with('category', $category)
			->with('cats', $cats);
			// ->with('subCategoryTotals', $subCategoryTotals);
	}

	public function uncategorized()
	{
		if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }
		$userId = Auth::user()->id;            

		$transactions = Transaction::where('user_id', '=', $userId)->where('category_id', '=', NULL)->orderBy('date', 'desc')->get();

		return view('categories.uncategorized')
			->with('transactions', $transactions);
	}

	public function confirmDelete(Category $category)
	{
		if(!Auth::check()) {
                return redirect('/login')
                    ->with('error', 'You must be logged in!');
            }
		return view('categories.confirmDelete')
			->with('category', $category);
	}

	public function delete(Category $category)
	{
		if(!Auth::user()->isOnTeam($category->team->id))
		{
			return redirect(route('home'))
			->with('error', 'You don\'t have access to that category');
		}
		if($category->subcategories)
		{
			$category->subcategories()->update(['pid' => NULL]);
		}
// Update transactions in subcategories with parent category id when subcategory is deleted. 
// 		if($category->transactions->parentCategory)
// 		{
// 			$category->transactions->update('category_id' => )
// 		}

		if($category->transactions)
		{
			if($category->parent)
			{
				$category->transactions()->update(['category_id' => $category->parent->id]);

			}
			else
			{
				$category->transactions()->update(['category_id' => NULL]);
			}
		}
		$category->delete();

		return redirect('/home')
			->with('success', 'Your Category has been deleted.');
	}

// 





















}
