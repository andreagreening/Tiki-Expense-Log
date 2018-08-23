@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Delete {{ $transaction->description }}?
				</div>
				<div class="panel-body text-center">

					<a href="{{ route('transaction.delete', $transaction ) }}" class="btn btn-success margin-10"><i class="fa fa-check-circle-o"></i>Yes, Delete</a>
					<a href="{{ route('home') }}">No, Go Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection