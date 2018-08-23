@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
            <div class="visible-xs">
                <div class="panel panel-default" id="addTransactionPanel">
                    <div class="panel-heading text-center">
                    <a  href="#addTransaction" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="addTransaction"><i class="fa fa-plus-square"></i> Add a Transaction</a>
                </div>
                <div class="panel-body collapse" id="addTransaction">
                    <form method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('date')? 'has-error' : "" }}">
                            <label class="control-label" for="date">Date</label>
                            <input type="text" name="date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control">
                        </div>
                        <div class="form-group {{ $errors->has('description')? 'has-error' : "" }}">
                            <label class="control-label" for="description">
                                Description
                            </label>
                            <input type="text" name="description" class="form-control" value="{{ old('description') ? old('description') : "" }}">
                        </div>
                        <div class="form-group {{ $errors->has('amount')? 'has-error' : "" }}">
                            <label class="control-label" for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control" value="{{ old('amount') ? old('amount') : "" }}">
                        </div>
                        <div class="form-group {{ $errors->has('category')? 'has-error' : "" }}">
                            <label class="control-label" for="category">Select a Category</label>
                            <select name="category_id" class="form-control">
                                <option value=""> </option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}
                                    @if($category->subcategories)
                                        @foreach($category->subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">-{{$subcategory->title }}</option>
                                      @endforeach

                                    @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success" value="Submit">
                    </form>
                </div>
                </div> {{-- end of panel --}}
            </div>
            <div class="panel panel-default" id="totalToDate">
                <div class="panel-heading text-center">
                    <h4>TOTAL</h4>


                </div>
                <div class="panel-body text-center">
                    <h1>${{ number_format($transactionSum, 2) }}</h1>
                </div>
            </div> {{-- end of panel--}}
            <div class="panel panel-default" id="filterBy">
                <div class="panel-body text-center">
                            <h3>Filter By</h3>
                    <form action="" method="get">
                            <div class="form-group">
                            <select name="timeframe" onchange="this.form.submit()" class="form-control">
                                <option value="mtd" {{ Request::get('timeframe') == 'mtd' ? 'selected' : ''}}>Month To Date</option>
                                <option value="week" {{ Request::get('timeframe') == 'week' ? 'selected' : ''}}>Last 7 Days</option>
                                <option value="this-year" {{ Request::get('timeframe') == 'this-year' ? 'selected' : ''}}>{{ date('Y') }}</option>
                                <option value="day" {{ Request::get('timeframe') == 'day' ? 'selected' : ''}}>Today</option>
                                {{-- <option onchange="" value="">Choose Dates</option> --}}
                            </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="datepicker">Choose Dates</label>
                                    <div class="row">
                                       <input type="text" name="startdate" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control"><input type="text" name="enddate" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control">

                                    </div> --}}
                            {{-- </div> --}}
                        </form>
                </div>
            </div> {{-- end of panel --}}
            <div class="panel panel-default" id="byCategoryChart">
                <div class="panel-body">

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                      google.charts.load("current", {packages:["corechart"]});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Category', 'Total Spent'],
                          @foreach($categoryTotals as $catId => $total)
                            ['{{ $catId }}', {{ $total }}],
                          @endforeach
                        ]);

                        var options = {
                          // title: 'My Daily Activities',
                          pieHole: 0.4,
                          legend:{position: 'bottom'},


                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                      }
                    </script>

                    <div id="donutchart"></div>


                </div>
            </div> {{-- end of panel--}}
            <div class="panel panel-default" id="addCategoryPanel">
                <div class="panel-heading text-center">
                    <a href="#addCategory" role="button" data-toggle="collapse" aira-expanded="false" aria-controls="addCategory"><i class="fa fa-plus-square"></i>  Add a Category</a>
                </div>
                <div class="panel-body text-center collapse" id="addCategory">
                    <form method="POST"  action="{{ route('category.store') }}" >
                        {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('title')? 'has-error' : "" }}">
                        <label class="control-label" for="title">
                            Title
                        </label>
                        <input type="text" name="title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="pid">Select a Parent Category</label>
                        <select name="pid" class="form-control">
                            <option value=""></option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>

                            @endforeach
                        </select>

                    </div>
                    <input type="submit" class="btn btn-success">
                    </form>

                </div>
            </div> {{-- end of panel --}}
        </div>
        <div class="col-sm-7 col-sm-offset-0 col-xs-10 col-xs-offset-1">
            <div class="hidden-xs">
                <div class="panel panel-default" id="addTransactionPanel">
                    <div class="panel-heading text-center">
                        <a  href="#addTransaction2" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="addTransaction"><i class="fa fa-plus-square"></i> Add a Transaction</a>
                    </div>
                    <div class="panel-body collapse" id="addTransaction2">
                    <form method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('date')? 'has-error' : "" }}">
                                <label class="control-label" for="date">Date</label>
                                <input type="text" name="date" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control">
                            </div>
                            <div class="form-group {{ $errors->has('description')? 'has-error' : "" }}">
                                <label class="control-label" for="description">
                                    Description
                                </label>
                                <input type="text" name="description" class="form-control" value="{{ old('description') ? old('description') : "" }}">
                            </div>
                            <div class="form-group {{ $errors->has('amount')? 'has-error' : "" }}">
                                <label class="control-label" for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" value="{{ old('amount') ? old('amount') : "" }}">
                            </div>
                            <div class="form-group {{ $errors->has('category')? 'has-error' : "" }}">
                                <label class="control-label" for="category">Select a Category</label>
                                <select name="category_id" class="form-control">
                                    <option value=""> </option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}
                                        @if($category->subcategories)
                                            @foreach($category->subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">-{{$subcategory->title }}</option>
                                          @endforeach

                                        @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </form>

                    </div>
                </div> {{-- end of panel --}}
            </div>
            <div class="panel panel-default" id="recentTransactions">
                <div class="panel-heading">
                    Recent Transactions
                </div>

                @if(!$transactions->isEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <tr class="table-heading">
                                <td>Date</td>
                                <td>Description</td>
                                <td>Amount</td>
                                <td>Category</td>
                            </tr>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date->format('m/d/y')  }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ number_format($transaction->amount, 2) }}</td>
                                <td><a href="{{ route('category.viewBy', $transaction->category) }}">{{ $transaction->category->title or "None" }}</a> <a href="{{ route('transaction.edit', $transaction) }}" class="pull-right"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
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
                    {{-- End of Panel --}}
            </div> {{-- end of panel --}}
        </div>




       {{--  <div class="col-sm-3">
            <a href="{{ route('category.create') }}" class="btn btn-default margin-bottom-20"><i class="fa fa-plus-square-o"></i> Add a Category</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Categories
                </div>
                <div class="list-group">
                    @foreach($categories as $category)
                        <div class="list-group-item">
                            <a href="{{ route('category.viewBy', $category) }}">{{ $category->title }}</a>
                            <a href="{{ route('category.edit', $category) }}" class="pull-right"><i class="fa fa-pencil"></i></a>
                        </div>

                    @endforeach
                    	<div class="list-group-item">
                    		<a href="{{ route('category.uncategorized')}} ">Uncategorized</a>
                    	</div>
                </div>

            </div> --}}

    </div>
</div>
@endsection
