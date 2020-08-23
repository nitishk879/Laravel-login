@component('mail::message')
# Introduction

New user <strong>{{ $user->name ?? '' }}</strong> Registered.

<strong>{{ $user->name ?? '' }}</strong> has register with <strong>{{ $user->email ?? '' }}</strong> email address

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
