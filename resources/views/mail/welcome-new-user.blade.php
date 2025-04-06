@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $user->name }}!

We are excited to have you on board. Below are your login details:

- **Email:** {{ $user->email }}
- **Temporary Password:** {{ $password }}

@component('mail::button', ['url' => route('login')])
Login Now
@endcomponent

For security reasons, we recommend that you change your password immediately after logging in.

If you have any questions, feel free to reach out to our support team.

Best Regards,  
**The {{ config('app.name') }} Team**
@endcomponent
