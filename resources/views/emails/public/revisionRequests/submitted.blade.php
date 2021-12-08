@component('mail::message')
# Revision request submitted
Hey {{ $revisionRequest->technicianFirstName }},

Thank you for submitting the revision request, we will review it shortly!

@component('mail::panel')
## Change request details
- Name: {{ $revisionRequest->name }}
- Category: {{ $revisionRequest->revisionCategory->name }}
- Description: {{ $revisionRequest->description }}
- Total files: {{ count($revisionRequest->revisionDocuments) }}
- Total comments: {{ count($revisionRequest->revisionComments) }}
@endcomponent

Once the request has been approved or denied, you will be notified by mail.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
