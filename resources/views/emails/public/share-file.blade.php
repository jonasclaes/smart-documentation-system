@component('mail::message')
# {{ __('Hello!') }}

{{ __('Here is your reference to the file that you just requested.') }}
{{ __('This link is valid for the next 24 hours.') }}

@component('mail::button', ['url' => $url])
{{ __('Open file') }}
@endcomponent

{{ __('Thanks,') }}<br>
{{ config('app.name') }}

<br>
<small>{{ __('If the link does not work, you can copy and paste this link in your browser of choice:') }} <a href="{{ $url }}" style="word-break: break-all">{{ $url }}</a></small>
@endcomponent
