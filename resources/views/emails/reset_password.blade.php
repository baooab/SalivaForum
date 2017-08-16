@component('mail::message')
# 密码重置

应您的要求，我们给你发来了一封密码重置邮件。请点击下面的链接：

@component('mail::button', ['url' => url(config('app.url').route('password.reset', $token, false))])
重置密码
@endcomponent

如果不是您本人操作，请忽略。

感谢，<br>
{{ config('app.name') }}
@endcomponent
