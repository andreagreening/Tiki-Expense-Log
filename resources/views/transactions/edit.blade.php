@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default side-border-primary">
				<div class="panel-heading">
					<h4>Edit Transaction</h4>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('transaction.update', $transaction) }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="form-group {{ $errors->has('date')? 'has-error' : "" }}">
							<label class="control-label" for="date">Date</label>
							<input type="text" name="date" value="{{ old('date') ? old('date') : $transaction->date->format('m/d/y') }}" class="form-control">
						</div>
						<div class="form-group {{ $errors->has('description')? 'has-error' : "" }}">
							<label class="control-label" for="description">
								Description
							</label>
							<input type="text" name="description" class="form-control" value="{{ old('description') ? old('description') : $transaction->description }}">
						</div>
						<div class="form-group {{ $errors->has('amount')? 'has-error' : "" }}">
							<label class="control-label" for="amount">Amount</label>
							<input type="text" name="amount" class="form-control" value="{{  old('amount', $transaction->amount) }}">
						</div>
						<div class="form-group {{ $errors->has('category')? 'has-error' : "" }}">
							<label class="control-label" for="category">Select a Category</label>
							<select name="category_id" class="form-control" value	>
								<option value=""> </option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : ''}}>{{ $category->title }}
										@if($category->subcategories)
											@foreach($category->subcategories as $subcategory)
												<option value="{{ $subcategory->id }}"> -{{ $subcategory->title }}</option>
											@endforeach
										@endif	
	

									</option>
								@endforeach
							</select>
						</div>
						<input type="submit" class="btn btn-success pull-right" value="Submit">
					</form>
					<a href="{{ route('transaction.confirmDelete', $transaction) }}"><i class="fa fa-trash"></i> Delete Transaction</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection