@component('mail::message')
# Revision request reopened

Hey {{ $revisionRequest->technicianFirstName }},

A revision request you created has been reopened.
You can find more information about this further down this email.

Once you've made the changes that have been requested, be sure to resubmit the request for approval.

@component('mail::panel')
## Information about the change
- Name: {{ $revisionRequest->name }}
- Category: {{ $revisionRequest->revisionCategory->name }}
- Description: {{ $revisionRequest->description }}

## Reason for reopening
{{ $message }}
@endcomponent

{{ __('This link is valid for the next 7 days.') }}

@component('mail::button', ['url' => $url])
    {{ __('Open file') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<br>
<small>{{ __('If the link does not work, you can copy and paste this link in your browser of choice:') }} <a href="{{ $url }}" style="word-break: break-all">{{ $url }}</a></small>
@endcomponent
