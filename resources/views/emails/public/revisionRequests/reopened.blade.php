@component('mail::message')
# {{ __('Revision request reopened') }}

{{ __('Hey') }} {{ $revisionRequest->technicianFirstName }},

{{ __('A revision request you created has been reopened.') }}
{{ __('You can find more information about this further down this email.') }}

{{ __("Once you've made the changes that have been requested, be sure to resubmit the request for approval.") }}

@component('mail::panel')
## {{ __('Information about the change') }}
- {{ __('Name') }}: {{ $revisionRequest->name }}
- {{ __('Category') }}: {{ $revisionRequest->revisionCategory->name }}
- {{ __('Description') }}: {{ $revisionRequest->description }}

## {{ __('Reason for reopening') }}
{{ $message }}
@endcomponent

{{ __('This link is valid for the next 7 days.') }}

@component('mail::button', ['url' => $url])
    {{ __('Open file') }}
@endcomponent

{{ __('Thanks,') }}<br>
{{ config('app.name') }}

<br>
<small>{{ __('If the link does not work, you can copy and paste this link in your browser of choice:') }} <a href="{{ $url }}" style="word-break: break-all">{{ $url }}</a></small>
@endcomponent
