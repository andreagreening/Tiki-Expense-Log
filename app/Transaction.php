<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
	protected $dates = ['date'];
	
    public function category()
    {
    	return $this->belongsTo('Category');
    }

    public function parentCategory()
    {
      // does this transactions category belong to a pid? then add to the category where the id=transaction->category->id. 
    }

    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function table()
    {
      return $this->belongsTo('Table');
    }

    public function scopeFilter($builder, $params)
    {
        //  default to mtd
        if(!isset($params['timeframe']))
            $params['timeframe'] = 'mtd';
        if ( isset($params['timeframe']) && trim($params['timeframe']) !== ''){
            switch ($params['timeframe']) {
                case 'week':
                   $startDate = Carbon::now()->subDays(7);
                   $endDate = Carbon::now();
                    break;
                
                case 'day':
                   $startDate = Carbon::now()->startOfDay();
                   $endDate = Carbon::now();
                    break;
                
                case 'this-year':
                   $startDate = Carbon::now()->startOfYear();
                   $endDate = Carbon::now();
                    break;

                case 'mtd':
                   $startDate = Carbon::now()->startOfMonth();
                   $endDate = Carbon::now();
                    break;
                
                default:
                    $startDate = Carbon::now()->startOfMonth();
                   $endDate = Carbon::now();
                    break;
            }
            $builder->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate);   
        }

        if ( isset($params['startdate']) && trim($params['startdate']) !== ''){
            $startDate = Carbon::parse($params['startdate']);
            // $endDate = Carbon::parse($params->enddate);
            $builder->where('date', '>=', $startDate);   
        }
        if ( isset($params['enddate']) && trim($params['enddate']) !== ''){
            $endDate = Carbon::parse($params['enddate']);
            // $endDate = Carbon::parse($params->enddate);
            $builder->where('date', '<=', $endDate);   
        }

        // next filter here
        return $builder;
    }

    public function team()
    {
      return $this->belongsTo('Team');
    }

    static function getDemoTransactions()
    {
      //Create array of arrays of transaction data. Each transaction will have a date of X days ago, going back 45 days. Each transaction will have a specific category, must find corresponding category id via category name. Each transaction has a specific amount. 

      $demoTransactions = [
        ['daysAgo' => 1, 'description' => 'Movie Date', 'amount' => '27', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 2, 'description' => 'Wholesome Market', 'amount' => '89', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 3, 'description' => 'Electric', 'amount' => '139', 'categoryTitle' => 'Utilities'],
        ['daysAgo' => 4, 'description' => 'Big Buzz Brewing', 'amount' => '67', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 5, 'description' => 'Visa Payment', 'amount' => '300', 'categoryTitle' => 'Credit Cards'],
        ['daysAgo' => 6, 'description' => 'Gas', 'amount' => '38', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 7, 'description' => 'Farmers Market', 'amount' => '27', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 8, 'description' => 'Oil Change', 'amount' => '25', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 9, 'description' => 'Wholesome Market', 'amount' => '42', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 10, 'description' => 'Dentist Co-Pay', 'amount' => '50', 'categoryTitle' => 'Health Care'],
        ['daysAgo' => 11, 'description' => 'Mortgage Payment', 'amount' => '785', 'categoryTitle' => 'Housing'],
        ['daysAgo' => 12, 'description' => 'Homeowners Insurance', 'amount' => '85', 'categoryTitle' => 'Housing'],
        ['daysAgo' => 13, 'description' => 'Splendid Produce', 'amount' => '47', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 14, 'description' => 'Gas', 'amount' => '47', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 15, 'description' => 'Health Insurance', 'amount' => '237', 'categoryTitle' => 'Health Care'],
        ['daysAgo' => 16, 'description' => 'Visa Payment', 'amount' => '300', 'categoryTitle' => 'Credit Cards'],
        ['daysAgo' => 17, 'description' => 'Cable', 'amount' => '78', 'categoryTitle' => 'Utilities'],
        ['daysAgo' => 18, 'description' => 'Bus Ticket', 'amount' => '19', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 19, 'description' => 'Gas', 'amount' => '36', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 20, 'description' => 'Wholesome Market', 'amount' => '216', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 21, 'description' => 'Wine Festival', 'amount' => '126', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 22, 'description' => 'Prescriptions', 'amount' => '29', 'categoryTitle' => 'Health Care'],
        ['daysAgo' => 23, 'description' => 'Farmers Market', 'amount' => '39', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 24, 'description' => 'Inn Hotel', 'amount' => '287', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 25, 'description' => 'Cell Phone', 'amount' => '65', 'categoryTitle' => 'Utilities'],
        ['daysAgo' => 26, 'description' => 'Farmers Market', 'amount' => '18', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 27, 'description' => 'Gas', 'amount' => '36', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 28, 'description' => 'Movie Date', 'amount' => '75', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 29, 'description' => 'Auto Insurance', 'amount' => '65', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 30, 'description' => 'Wholesome Foods', 'amount' => '167', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 31, 'description' => 'Gym Membership', 'amount' => '65', 'categoryTitle' => 'Health Care'],
        ['daysAgo' => 32, 'description' => 'Homeowners Insurance', 'amount' => '85', 'categoryTitle' => 'Housing'],
        ['daysAgo' => 33, 'description' => 'Mortgage Payment', 'amount' => '785', 'categoryTitle' => 'Housing'],
        ['daysAgo' => 34, 'description' => 'Car Payment', 'amount' => '145', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 35, 'description' => 'Electric', 'amount' => '67', 'categoryTitle' => 'Utilities'],
        ['daysAgo' => 36, 'description' => 'Dinner Date', 'amount' => '65', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 37, 'description' => 'Gas', 'amount' => '25', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 38, 'description' => 'Wholesome Foods', 'amount' => '65', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 39, 'description' => 'Concert', 'amount' => '190', 'categoryTitle' => 'Entertainment'],
        ['daysAgo' => 40, 'description' => 'Plumber', 'amount' => '250', 'categoryTitle' => 'Housing'],
        ['daysAgo' => 41, 'description' => 'Visa Payment', 'amount' => '250', 'categoryTitle' => 'Credit Cards'],
        ['daysAgo' => 42, 'description' => 'Student Loans', 'amount' => '500', 'categoryTitle' => 'Debt'],
        ['daysAgo' => 43, 'description' => 'Gas', 'amount' => '43', 'categoryTitle' => 'Automotive/Transportation'],
        ['daysAgo' => 44, 'description' => 'Farmers Market', 'amount' => '29', 'categoryTitle' => 'Food and Groceries'],
        ['daysAgo' => 45, 'description' => 'Tires', 'amount' => '275', 'categoryTitle' => 'Automotive/Transportation']


        




        
      ];
   

      return $demoTransactions;
    }
    




}
