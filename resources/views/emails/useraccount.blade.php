@component('mail::message')
# Account created

Click on the button to activate your account

@component('mail::button', ['url' => route('activate-account', $user->activation_token)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
