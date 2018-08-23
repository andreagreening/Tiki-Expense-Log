@component('mail::message')
# Hey {{ $userName }}, {{ $newTeammate }} is now on your team!

@component('mail::button', ['url' => $url, 'color' => 'green'])
View your Team Manager
@endcomponent










Thanks,<br>
{{ config('app.name') }}
@endcomponent