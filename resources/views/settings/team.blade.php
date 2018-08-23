@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default border-primary padding-bottom-20 padding-top-15 padding-bottom-30 no-radius">
                    <div class="panel-body">
                        <h1 class="text-center">{{ $team->name ?: $team->owner->name }}</h1>
                        <a class="" role="button" data-toggle="collapse" href="#changeTeamName" aria-expanded="false" aria-controls="collapseExample">Change My Team Name</a>
                        <div class="collapse" id="changeTeamName">
                            <form action="{{ route('team.changeName', $team)}}" method="POST">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="teamName">
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-success" value="Submit">

                                    </div>    
                                </div>
                                

                            </form>
                        </div>
                    </div>
                </div>

				<div class="panel panel-default side-border-primary">
					<div class="panel-body">
                        <h5>Invite a Friend to Join Your Team</h5>
    					<div class="form-group">
    						<form action="{{ route('team.inviteSent') }}">
    							<div class="input-group">
    								<input type="email" name="email" class="form-control" placeholder="Enter your friend's email address">
                                    <span class="input-group-btn">
    								<input type="submit" class="btn btn-success" value="Send">
                                    </span>
    							</div>
    						</form>
    					</div>
					</div>
				</div>

			@if(!$users->isEmpty()) 
				<div class="panel panel-default border-primary">
                    <div class="panel-heading">
                        <h4 class="margin-left-15">Users on My Team</h4> 
                    </div>
                        <div class="list-group">
                            @foreach($users as $user)
                            <div class="list-group-item">
                                {{ $user->name }} <a href="{{ route('team.removeUser', $user) }}" class="pull-right">Remove</a>
                            </div>
                            @endforeach
                        </div>  
                    </div>  
            @endif	
        </div>	
		<div class="col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			@if(!$onTeams->isEmpty())
            {{-- This will show the teams I am on --}}
                <div class="panel panel-default border-primary">
                    <div class="panel-heading">Teams I'm On</div>
                    <div class="list-group">
                        @foreach($onTeams as $onTeam)
                        <div class="list-group-item">
                            <a href="{{ route('dashboard', $onTeam->id) }}">{{ $onTeam->owner->name }}</a>
                            <a href="{{ route('team.leave', $onTeam->id) }}" class="btn btn-warning btn-xs pull-right">Leave Team</a>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- end of panel --}}
            @endif

            @if(!$invitesRecieved->isEmpty())
				
				<div class="panel panel-default border-primary">
					<div class="panel-heading">Invites Recieved</div>
						<div class="list-group">
						@foreach($invitesRecieved as $invite) 
							<div class="list-group-item">
								{{ $invite->team->owner->name }}
								<a href="{{ route('team.deleteInvite', $invite->id) }}" class="btn btn-xs btn-danger pull-right">Deny</a>
								<a href="{{ route('team.acceptInvite', $invite->token) }}" class="btn btn-xs btn-success pull-right margin-right-10">Accept</a>
							</div>
						@endforeach	
						</div>
				</div>
            @endif

            @if(!$invitesSent->isEmpty())
                <div class="panel panel-default border-primary">
                    <div class="panel-heading">
                        Invites I've Sent
                    </div>
                    <div class="list-group">
                    @foreach($invitesSent as $inviteSent)
                            <div class="list-group-item">
                                {{ $inviteSent->email }}
                                <a href="{{ route('team.deleteInvite', $inviteSent->id) }}" class="btn btn-danger btn-xs pull-right">Cancel</a>
                            </div>
                    @endforeach
                    </div>
                </div>
            @endif
		</div>
	</div>
	{{-- end of row --}}
</div>
@endsection

