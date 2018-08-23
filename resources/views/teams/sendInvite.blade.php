@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Send an Invite</div>
				<div class="panel-body">
					<div class="form-group">
						<form action="{{ route('team.inviteSent') }}">
							
								<input type="email" name="email" class="form-control" placeholder="email">
								<input type="submit" class="btn btn-success" value="Send">
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection