@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $category->title }} Transactions
				</div>
				<div class="table-responsive">
				<table class="table table-hover table-striped">
				
				<tr>
					<td>Date</td>
					<td>Description</td>
					<td>Amount</td>
				</tr>
					
					@foreach($transactions as $transaction)
					<tr>
						<td>{{ $transaction->date->format('m/d/y') }}</td>
						<td>{{ $transaction->description }}</td>
						<td>{{ number_format($transaction->amount, 2) }} <a href="{{ route('transaction.edit', $transaction) }}" class="pull-right"><i class="fa fa-pencil"></i></a></td>
					</tr>
					@endforeach
				</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection