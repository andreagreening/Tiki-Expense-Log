@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-body">
				<form method="GET" action="{{ route('team.inviteSent') }}">
					<div class="form-group">
						<label for="inviteEmail">Would you like to invite another friend to this team?</label>
						<input type="email" class="form-control" placeholder="Enter your friend's email.">
					</div>
					<input type="submit" class="btn btn-success" value="Send">
				</form>

				<a href="{{ route('home') }}" class="btn btn-primary margin-top-15">No Thanks, I'm done.</a>
			</div>
		</div> {{-- end of panel --}}
		</div> {{-- end of column --}}
	</div>
</div>


@endsection