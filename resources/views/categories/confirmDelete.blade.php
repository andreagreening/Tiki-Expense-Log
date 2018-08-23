@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading heading-font">
					Delete {{ $category->title }}?
				</div>
				<div class="panel-body text-center">
						<a href="{{ route('category.delete', $category ) }}" class="btn btn-success margin-10"><i class="fa fa-check-circle-o"></i>Yes, Delete</a>
					<a href="{{ route('home') }}" class="margin-10">No, Go Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection