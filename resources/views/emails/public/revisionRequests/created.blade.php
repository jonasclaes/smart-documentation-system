@component('mail::message')
# {{ __('New revision request created') }}

{{ __('Hey') }} {{ $revisionRequest->technicianFirstName }},

{{ __('Thank you for creating a new revision request!') }}

{{ __('This request has not been submitted for review yet.') }}
{{ __('This means that you can still add files, make comments, update the description....') }}

{{ __("Once you're done, click on the submit button, and we will review this as soon as possible.") }}

@component('mail::panel')
## {{ __('Information about you') }}
- {{ __('Name') }}: {{ $revisionRequest->technicianLastName }}, {{ $revisionRequest->technicianFirstName }}
- {{ __('E-mail') }}: {{ $revisionRequest->technicianEmail }}

## {{ __('Information about the change') }}
- {{ __('Name') }}: {{ $revisionRequest->name }}
- {{ __('Category') }}: {{ $revisionRequest->revisionCategory->name }}
- {{ __('Description') }}: {{ $revisionRequest->description }}
@endcomponent

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent
