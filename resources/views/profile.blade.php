@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $user->name }}'s Profile
					</div>
					<div class="panel-body">
						<a href="" class="btn btn-default"><i class="fa fa-plus-circle"></i>Add {{ $user->name }} to your tracker.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection
