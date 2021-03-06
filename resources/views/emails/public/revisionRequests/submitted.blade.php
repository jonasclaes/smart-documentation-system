@component('mail::message')
# {{ __('Revision request submitted') }}
{{ __('Hey') }} {{ $revisionRequest->technicianFirstName }},

{{ __('Thank you for submitting the revision request, we will review it shortly!') }}

@component('mail::panel')
## {{ __('Change request details') }}
- {{ __('Name') }}: {{ $revisionRequest->name }}
- {{ __('Category') }}: {{ $revisionRequest->revisionCategory->name }}
- {{ __('Description') }}: {{ $revisionRequest->description }}
- {{ __('Total files') }}: {{ count($revisionRequest->revisionDocuments) }}
- {{ __('Total comments') }}: {{ count($revisionRequest->revisionComments) }}
@endcomponent

{{ __('Once the request has been approved or denied, you will be notified by mail.') }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent
