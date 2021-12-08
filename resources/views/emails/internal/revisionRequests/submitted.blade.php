@component('mail::message')
# Revision request submitted

A new revision request has been submitted.

@component('mail::panel')
## Information about the submitter
- Name: {{ $revisionRequest->technicianLastName }}, {{ $revisionRequest->technicianFirstName }}
- E-mail: <a href="{{ $revisionRequest->technicianEmail }}" style="word-break: break-all">{{ $revisionRequest->technicianEmail }}</a>

## Information about the change request
- Name: {{ $revisionRequest->name }}
- Category: {{ $revisionRequest->revisionCategory->name }}
- Description: {{ $revisionRequest->description }}
- Total files: {{ count($revisionRequest->revisionDocuments) }}
- Total comments: {{ count($revisionRequest->revisionComments) }}
@endcomponent

If you want to moderate this revision request, you can use this link: <a href="{{ route('dashboard') }}" style="word-break: break-word">{{ route('dashboard') }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
