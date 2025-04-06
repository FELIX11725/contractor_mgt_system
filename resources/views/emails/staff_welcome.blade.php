@component('mail::message')
# Welcome to {{ $mailData['business_name'] }}, {{ $mailData['name'] }}!

Your account has been created successfully. Here are your login credentials:

**Email:** {{ $mailData['email'] }}  
**Password:** {{ $mailData['password'] }}

@component('mail::button', ['url' => $mailData['login_url']])
Login to Your Account
@endcomponent

For security reasons, please change your password after your first login.

If you didn't request this account, please contact your administrator immediately.

Thanks,  
{{ config('app.name') }} Team
@endcomponent