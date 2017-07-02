@component('mail::message')
# Welcome to Laravel!

Thanks for joining up with the [Laravel](https://laravel.com) world!

We just need to confirm your email address so please click the button below to confirm it:

@component('mail::button', ['url' => route('email.confirm', [$user->email, $user->confirmation_code])])
Confirm Email Address
@endcomponent

We hope to see you soon on the portal.

Regards,<br>
{{ config('app.name') }}
@endcomponent
