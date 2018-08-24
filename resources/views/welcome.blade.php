
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="text-center welcome">
        		<h1>Welcome to Tiki Expense Log</h1>
        		<a href="{{ route('demo') }}" style="color:white"><h3 class="btn btn-success btn-lg">Try it now.</h3></a>
        	</div>
        </div>
        <div class="row welcomeabout">
        	<div class="col-sm-8 center-block">
        		<img src="/storage/images/548202f54b1f89ef2a705028232ccd0e.png" class="img-responsive img-thumbnail" alt="">
        	</div>
            <div class="col-sm-4">
                TikiLog is a simple expense logger that allows you to share with a team. 
                Use it to:
                <ul>
                    <li>Manage Household Finances with your spouse.</li>
                    <li>Keep track of your spending on vacation.</li>
                    <li>Control project budgets with coworkers.</li>
                    
                </ul>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
@endsection