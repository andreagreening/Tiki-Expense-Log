@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Settings
					<ul class="nav nav-pills nav-justified">
						<li role="presentation" class="active"><a href="{{ route('settings.account')}}">Team</a></li>
						<li role="presentation"><a href="{{ route('settings')}}">User</a></li>
					</ul>
				</div>
				<div class="panel-body">
					@if(!$users->isEmpty())
						<div class="row">
							<div class="col-xs-6 margin-top-20">
								<div class="panel panel-info">
									<div class="panel-heading clearfix">
										<h4 class="margin-left-15">Users on Team</h4> <a href="{{ route('team.sendInvite') }}" class="btn btn-success"><i class="fa fa-plus-square"></i>  Add User</a>
									</div>
										<div class="list-group">
											@foreach($users as $user)
											<div class="list-group-item">
												{{ $user->name }} <a href="" class="pull-right">Remove</a>
											</div>
											@endforeach
										</div>	
									</div>	
							</div>
						</div>
					@else
						<h4></h4>		
					@endif
				</div>
			</div>
		</div>
	</div>
</div>


@endsection