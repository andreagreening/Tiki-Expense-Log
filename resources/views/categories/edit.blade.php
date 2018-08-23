@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit Category 
					<a href="{{ route('category.confirmDelete', $category) }}" class="btn btn-xs btn-danger pull-right">Delete</a>
				</div>
				<div class="panel-body">
					<form method="POST"  action="{{ route('category.update', $category) }}" >
						{{ csrf_field() }}
					<div class="form-group {{ $errors->has('title')? 'has-error' : "" }}">
						<label class="control-label" for="title">
							Title
						</label>
						<input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $category->title }}">
					</div>

					<div class="form-group">
						<label for="pid">Select a Parent Category</label>
						<select name="pid" class="form-control">
							<option value=""></option>
							@foreach($categories as $cat)
							<option value="{{ $cat->id }}" {{ $category->pid == $cat->id ? 'selected' : ''}}>{{ $cat->title }}</option>

								
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