@component('mail::message')
# Welcome

You have been invited!

@component('mail::button', ['url' => $url,
	'color' => 'blue'])
Accept Team Invite
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent