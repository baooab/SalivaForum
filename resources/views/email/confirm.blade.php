@component('mail::message')
# 账号激活

欢迎您，在本站注册账号。在你使用之前，需要激活账号。

@component('mail::button', ['url' => route('verify', ['confirm_code' => $user->confirm_code])])
点击激活
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent