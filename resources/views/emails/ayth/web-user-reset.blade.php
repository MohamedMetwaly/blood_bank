@component('mail::message')
# Hello!

You are receiving this email because we received a password reset
request for your account.


@component('mail::button', ['url' => url(route("userNewPassword"))])
Reset Password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
