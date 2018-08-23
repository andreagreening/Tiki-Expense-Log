<div class="panel panel-default dashboard-collapse-button side-border-primary">
    <div class="panel-heading text-center" data-target="#{{ $categoryManagerId }}" role="button" data-toggle="collapse" aira-expanded="false" aria-controls="{{ $categoryManagerId }}"><i class="fa fa-check-square fa-3x">
       </i>
		<br>

        Manage Categories
    </div>
        <div class="panel-body collapse" id="{{ $categoryManagerId }}">

		
 			<ul style="list-style-type:none">
				@foreach($categories as $category)
					<li>
						 <span class="bold"><a href="{{ route('category.viewBy', $category) }}">{{ $category->title }}</a></span>  <a class="pull-right" href="{{ route('category.edit', $category) }}">Edit</a>
						@if($category->subcategories)
							<ul>
							@foreach($category->subcategories as $subcategory)
							<li class=><i class="fa fa-ellipsis-h-alt"></i><span class="bold"><a href="{{ route('category.viewBy', $subcategory) }}">{{ $subcategory->title }}</a></span>
							<a href="{{ route('category.edit', $subcategory) }}" class="pull-right">Edit</a></li>
							@endforeach
							</ul>
						@endif
					</li>
				@endforeach
			</ul>
		</div>
</div>