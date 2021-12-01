@component('mail::message')
# Hello!

Here is your reference to the file that you just requested.
This link is valid for the next 24 hours.

@component('mail::button', ['url' => $url])
Open file
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<br>
<small>If the link does not work, you can copy and paste this link in your browser of choice: <a href="{{ $url }}">{{ $url }}</a></small>
@endcomponent
