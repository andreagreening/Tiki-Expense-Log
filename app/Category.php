<?php

namespace App;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Transactions;

class Category extends Model
{

	//	List of default categories created for each user in UserObserver:
	static function getDefaultCategories()
	{
		return ['Housing', 'Utilities', 'Health Care', 'Debt', 'Food and Groceries', 'Entertainment', 'Automotive/Transportation'];
	}

	static function getDefaultSubCategories()
	{
		
		$subcats = [
			'Debt'	=> ['Loans', 'Credit Cards'],
			'Food and Groceries'	=>	['Alcohol, Bars and Restaurants']
		];
		return $subcats;
	}

	public function transactions()
	{
    	return $this->hasMany('Transaction');
		
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function parent()
	{
		return $this->belongsTo('Category', 'pid')->where('pid', NULL)->with('parent');
	}



	public function subcategories()
	{
		return $this->hasMany('Category', 'pid')
			->with('subcategories')
			->withoutGlobalScope('noSubcategories');
	}

	public function table()
	{
		return $this->belongsTo('Table');
	}

	protected static function boot()
	{
		parent::boot();
		// static::addGlobalScope('noSubcategories', function(Builder $builder){
		// 	$builder->whereNull('pid');
		// });
	}

	// Hide Sub Categories when needed,
	//	Like when building a dropdown list
	public function scopeNoSubCats($builder)
	{
		return $builder->whereNull('pid');
	}

	public function team()
	{
		return $this->belongsTo('Team');
	}

	public function parentCategoryTotals()
	{
		 //  Grab all Categories for Team, to get Name from ID
        //  Saves us database calls
        $teamCategories = $team->categories->pluck('title', 'id')->toArray();
        //  Build Array of Totals By Category
         $transactionsForLoop = $team->transactions()
            ->filter($request->all())
            ->orderBy('date', 'desc')
            ->get();
        $categoryTotals = [];
        foreach($transactionsForLoop as $transaction){
            $categoryId = $transaction->category_id;
            $categoryName = 'Uncategorized';
            if($categoryId && isset($teamCategories[$categoryId])) $categoryName = $teamCategories[$categoryId];
            // First Trans. in this cat, use this trans. amount
            if(!isset($categoryTotals[$categoryName])){
                $categoryTotals[$categoryName] = $transaction->amount;
            } else { // add this to the running total for cat.
                $categoryTotals[$categoryName] += $transaction->amount;
            }
       }

	}
	
	/**
    *		Get ids of subcats
    */
    public static function getSubCatIds($id, $includeSubCats = true)
    {
		$category = Category::find($id);
    	$categoryIds = [$category->id];
    	if($includeSubCats){
    		$categoryIds = $category->subcategories()->pluck('id')->toArray();
    		$categoryIds[] = $id;
    	}
    	return $categoryIds;
    }

    public function subCategoryTotal()
    {
    	$request = request();
    	$subGrandTotal = Transaction::where('category_id', $this->id)
    		->filter($request->all())
            ->orderBy('date', 'desc')
            ->sum('amount');

            return $subGrandTotal;
    }

    public function grandTotal()
    {	 
    	$request = request();
    	$grandTotal = Transaction::whereIn('category_id',Category::getSubCatIds($this->id))
    		->filter($request->all())
            ->orderBy('date', 'desc')
            ->sum('amount');

        return $grandTotal;   
    }
	
    public function link()
    {
    	return route('category.viewBy', $this);
    }









}
