@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit Category 
				</div>
				<div class="panel-body">
					<form method="POST"  action="{{ route('category.update', [$category, $category->team]) }}" >
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
					<a href="{{ route('category.confirmDelete', $category) }}"><i class="fa fa-trash"></i> Delete Category</a>
					<input type="submit" class="btn btn-success pull-right">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection