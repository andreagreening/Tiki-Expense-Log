@component('mail::message')
# Hey {{ $userName }}, your password has been changed!

@component('mail::button', ['url'=> $url, 'color' => 'green'])
Go to my Settings
@endcomponent

@endcomponent

