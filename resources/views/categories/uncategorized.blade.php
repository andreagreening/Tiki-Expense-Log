@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Uncategorized Transactions
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Amount</td>
						</tr>

						@if(!$transactions->isEmpty())
							
						@foreach($transactions as $transaction)
						<tr>
							<td>{{ $transaction->date->format('m/d/y') }}</td>
							<td>{{ $transaction->description }}</td>
							<td>{{ number_format($transaction->amount, 2) }} <a href="{{ route('transaction.edit', $transaction) }}" class="pull-right"><i class="fa fa-pencil"></i></a></td>
						</tr>
						@endforeach
						@else
						<tr>
							<td>There are no transactions.</td>
						</tr>	
						@endif
					</table>
				</div>

			</div>
			{{-- end of panel --}}
			{{-- <div class="panel panel-default">
				<div class="panel-heading">
					Sort By Date
				</div>
				<div class="panel-body">
					<form method="GET" action="{{ route('category.sortByDate') }}">
						{{ csrf_field() }}
						<input type="date" name="startdate">
						<input type="date" name="enddate">

						<input type="submit">
					</form>
				</div>
			</div> --}}
		</div>
	</div>
</div>
@endsection
