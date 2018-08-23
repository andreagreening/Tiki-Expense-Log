@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-xs-12">
			<div class="panel panel-default border-primary">
				<h4 class="padding-left-15 padding-bottom-15">{{ $category->team->name ?: $category->team->owner->name }}</h4>
				<ol class="breadcrumb">
					@if($category->parent)
					<li><a href="{{ route('category.viewBy', $category->parent) }}">{{ $category->parent->title }}</a></li>
					@endif
					<li>{{ $category->title }}</li>
				</ol>
			</div>

			@include('partials.total')

			@include('dashboard.filterBy')
			
			{{-- end of panel --}}
			{{-- CHART BELOW contains breakdown of category into subcategories --}}


			 
			@if(!$category->subcategories->isEmpty())
				@include('partials.viewByCategoryChart')
			@endif
			
			
			<div class="panel panel-default border-primary">
				@include('partials.transactionPanel')
			</div>
			
			
			
		</div>
	</div>
</div>

	
@endsection