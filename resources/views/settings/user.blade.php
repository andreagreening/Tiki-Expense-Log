@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Settings</h3>
				</div>

			</div>
			<div class="panel panel-default dashboard-collapse-button side-border-primary" id="changeNamePanel">
                <div class="panel-heading text-center"  data-target="#changeName" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="changeName">
                   Change Your Name
                </div>
                <div class="panel-body collapse" id="changeName">
                	<form method="POST" action="{{ route('settings.changeName') }}">
                		{{ csrf_field() }}

                		 <input type="text" name="userName" value="{{ $user->name }}" class="form-control">
							
							<input type="submit" class="btn btn-success margin-top-10" value="Save">

                	</form>
                </div>
            </div> 
            {{-- end of collapsible panel --}}

			<div class="panel panel-default dashboard-collapse-button side-border-primary" id="changePasswordPanel">
                <div class="panel-heading text-center"  data-target="#changePassword" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="changePassword">
                   Change Your Password
                </div>
                <div class="panel-body collapse" id="changePassword">
                	<form method="POST" action="{{ route('settings.changePassword') }}">
                		{{ csrf_field() }}
						<div class="form-group">
                		 	<label for="currentPassword" class="control-label">Current Password</label>
                		 	<input type="password" name="currentPassword" value="" class="form-control">
                		 </div>

                		 <div class="form-group">
                		 	<label for="newPassword" class="control-label">New Password</label>
                		 	<input type="password" name="newPassword" value="" class="form-control">
                		 </div>

                		 <div class="form-group">
                		 	<label for="confirmNewPassword" class="control-label">Confirm New Password</label>
                		 	<input type="password" name="confirmNewPassword" value="" class="form-control">
                		 </div>
                		
							
							<input type="submit" class="btn btn-success margin-top-10" value="Save">

                	</form>
                </div>
            </div>
            {{-- end of collapsible panel --}}
			
			<div class="panel panel-default dashboard-collapse-button side-border-primary" id="changeEmailPanel">
                <div class="panel-heading text-center"  data-target="#changeEmail" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="changeEmail">
                   Change Your Email Address
                </div>
                <div class="panel-body collapse" id="changeEmail">
                	<form method="POST" action="{{ route('settings.changeEmail') }}">
                		{{ csrf_field() }}

                		 <input type="email" name="email" value="{{ $user->email }}" class="form-control">
							
							<input type="submit" class="btn btn-success margin-top-10" value="Save">

                	</form>
                </div>
            </div> 

            <div class="panel panel-default dashboard-collapse-button side-border-primary" id="deleteAccountPanel">
                <div class="panel-heading text-center"  data-target="#deleteAccount" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="deleteAccount">
                   Delete Your Account
                </div>
                <div class="panel-body collapse text-center" id="deleteAccount">
                <h2>Are you sure you'd like to delete your account?</h2>
                <h4>This will also delete all of your transactions and categories. You will no longer have access to any teams you're on. </h4>
                    <a href="{{ route('settings.deleteAccount') }}" class="btn btn-danger">Yes, DELETE my account.</a>
                    <br>
                    <a href="#deleteAccount" data-toggle="collapse" class="pull-right">No thanks, nevermind.</a>
                </div>
            </div> 




		</div>
	</div>
</div>


@endsection