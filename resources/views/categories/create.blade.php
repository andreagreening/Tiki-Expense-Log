@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Create a Category
				</div>
				<div class="panel-body">
					<form method="POST"  action="{{ route('category.store') }}" >
						{{ csrf_field() }}
					<div class="form-group {{ $errors->has('title')? 'has-error' : "" }}">
						<label class="control-label" for="title">
							Title
						</label>
						<input type="text" name="title" class="form-control" value="">
					</div>
					<div class="form-group">
						<label for="pid">Select a Parent Category</label>
						<select name="pid" class="form-control">
							<option value=""></option>
							@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->title }}</option>
							
							@endforeach
						</select>
						
					</div>
					<input type="submit" class="btn btn-success">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection