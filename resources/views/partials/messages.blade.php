


@if (isset($errors) && $errors->any())
<div class="container">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif





@if(Session::has('error'))
<div class="container">
	<div class="col-xs-12">
		<div class="alert alert-error">
			{!! Session::get('error') !!}
		</div>
	</div>
</div>
@endif
@if(Session::has('success'))
<div class="container">
	<div class="col-xs-12">
		<div class="alert alert-success">
			{!! Session::get('success') !!}
		</div>
	</div>
</div>
@endif
@if(Session::has('info'))
<div class="container">
	<div class="col-xs-12">
		<div class="alert alert-info">
			{!! Session::get('info') !!}
		</div>
	</div>
</div>
@endif
@if(Session::has('warning'))
<div class="container">
	<div class="col-xs-12">
		<div class="alert alert-warning">
			{!! Session::get('warning') !!}
		</div>
	</div>
</div>
</div>
@endif