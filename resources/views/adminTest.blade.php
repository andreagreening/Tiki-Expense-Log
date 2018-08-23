@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
        @if(Auth::user()->isDemo())
            <h3>cool.</h3>
        @else
            <h4>super rad.</h4>    
        @endif
           

        </div>
        
    </div>

@endsection
