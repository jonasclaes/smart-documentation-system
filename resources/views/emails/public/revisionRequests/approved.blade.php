@component('mail::message')
# {{ __('Revision request approved') }}
{{ __('Hey') }} {{ $revisionRequest->technicianFirstName }},

{{ __('Thank you for submitting the revision request, we have approved it!') }}

@component('mail::panel')
## {{ __('Change request details') }}
- {{ __('Name') }}: {{ $revisionRequest->name }}
- {{ __('Category') }}: {{ $revisionRequest->revisionCategory->name }}
- {{ __('Description') }}: {{ $revisionRequest->description }}
- {{ __('Total files') }}: {{ count($revisionRequest->revisionDocuments) }}
- {{ __('Total comments') }}: {{ count($revisionRequest->revisionComments) }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
