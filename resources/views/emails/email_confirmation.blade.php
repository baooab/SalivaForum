@component('mail::message')
# 很高兴见到你！

新朋友，欢迎加入 [乱炖社区](http://www.baooab.com) ！

但开始前，我们需验证您的邮箱：

@component('mail::button', ['url' => route('email.confirm', [$user->email, $user->confirmation_code])])
验证邮箱
@endcomponent

再见哦。

您的，<br>
{{ config('app.name') }}
@endcomponent
