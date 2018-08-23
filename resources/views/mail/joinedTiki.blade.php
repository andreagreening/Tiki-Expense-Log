@component('mail::message')
# Hey {{ $userName }}, Welcome to Tiki Log! 

@component('mail::button', ['url' => $url, 'color' => 'green'])
Begin Tracking
@endcomponent

@endcomponent