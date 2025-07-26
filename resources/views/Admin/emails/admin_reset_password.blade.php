@component('mail::message')
# Rest Your Password

You Can Reset You Password Here
We try to help you if you forgot your password
<br><br>
If you have any problem please contact Admin to solve 
your problem with password

@component('mail::button', ['url' => route('admin.reset_password',$data['token']) ])
    Reset Your Password Now .
@endcomponent

or copy this link !
<a target="_blank" href="{{ route('admin.reset_password',$data['token']) }}">{{ route('admin.reset_password',$data['token']) }}</a>
Thanks,<br>
{{ $data['data']->first_name }} {{ $data['data']->last_name }}
@endcomponent
