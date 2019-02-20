@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        {{-- Add Transaction Collapsed Panel --}}
            <div class="visible-xs">
                  @include('transactions.addTransaction', ['addTransactionId' => 'addTransaction1'])
                 @include('categories.addCategory', ['addCategoryId' => 'addCategory1'])
            </div>
            <div class="panel-group"> 
                <div class="panel panel-default border-primary padding-bottom-20 padding-top-15 no-radius">
                    <h1 class="text-center">{{ $team->name ?: $team->owner->name }}</h1>
                </div>
                {{-- end of panel --}}
                {{-- Toggle Between Team Trackers --}}
                @if(!$teamsList->isEmpty())
                <div class="panel panel-default side-border-primary text-center no-radius">
                    <div class="btn-group">
                        <div class="panel-heading center-block">
                            <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select a Team <span class="caret"></span>
                            </div>
                            <ul class="dropdown-menu text-center">
                                @foreach($teamsList as $teamList)
                                    <li><a href="{{ route('dashboard', $teamList) }}">{{ $teamList->name }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ route('dashboard', Auth::user()->team) }}">My Team</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif  
                {{-- end of panel --}}
            </div>
        
               @include('partials.total')
               @include('dashboard.filterBy')
               @if(!$transactions->isEmpty())
                    @include('partials.categoryChart') 
               @endif
                @include('categories.manage', ['categoryManagerId' => 'categoryManager2'])
        </div>
      
        {{-- Add Transaction for Larger Screens --}}
        <div class="col-sm-7 col-sm-offset-0 col-xs-10 col-xs-offset-1">
            <div class="hidden-xs">
                @include('transactions.addTransaction', ['addTransactionId' => 'addTransaction2'])
                 {{-- Add Category --}}
                @include('categories.addCategory', ['addCategoryId' => 'addCategory2'])
            </div>
            <div class="panel panel-default border-primary" id="recentTransactions">
                <div class="panel-heading heading-font">
                    Recent Transactions  <span class="pull-right">
                    @if(count(Request::except('page')))
                        <a href="{{ route('dashboard', $team) }}">Clear Filters</a>
                    @endif
                    </span>
                    @if(Request::has('startdate'))
                        {{ Request::get('startdate') }} - {{ Request::get('enddate') }}
                    @endif 
                    <br>
                    @if(Request::get('category_id') && $team->categories()->where('id', Request::get('category_id'))->first())
                        <a href="{{ route('dashboard', ['team' => $team->id] + Request::except('category_id')) }}"><span class="label label-default"><i class="fa fa-times-circle"></i> {{ Category::find(Request::get('category_id'))->title  }}</span></a>
                    @endif   

                    @if(Request::get('user_id') && $team->users->where('id', Request::get('user_id'))->first())
                        <a href="{{ route('dashboard', ['team' => $team->id] + Request::except('user_id')) }}">
                            <span class="label label-default"><i class="fa fa-times-circle"></i> {{ User::find(Request::get('user_id'))->name }}</span>
                        </a>
                    @endif      
                </div>

                @if(!$transactions->isEmpty())
                  @include('partials.transactionPanel')
                    <div class="text-center">
                        {!! $transactions->appends(Request::all())->links() !!}
                    </div>
                @else
                    <div class="panel-body">
                    <h4>There are no transactions yet!</h4>
                    </div>
                @endif
                        </div>
                    </div>
            </div> {{-- end of panel --}}
        </div>
    </div>
</div>
@endsection
