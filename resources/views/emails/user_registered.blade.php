@component('mail::message')
# Welcome

Hello {{$user->name}},

Welcome to Automovs. Thanks for signing up with Automovs.

@component('mail::button', ['url' => '/'])
Visit Site
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
