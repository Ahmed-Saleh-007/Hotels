@component('mail::message')
# Reset Account

Welcome {{ $data['data']->name }}

{{-- The body of your message. --}}

@component('mail::button', ['url' => route('dashboard.reset_password', $data['token']) ])
Click Here To Reset Password
@endcomponent

Or <br>
Copy This Link <a href="{{ route('dashboard.reset_password', $data['token']) }}">{{ route('dashboard.reset_password', $data['token']) }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
