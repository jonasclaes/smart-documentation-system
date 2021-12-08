@component('mail::message')
# New revision request created

Hey {{ $revisionRequest->technicianFirstName }},

Thank you for creating a new revision request!

This request has not been submitted for review yet.
This means that you can still add files, make comments, update the description....

Once you're done, click on the submit button, and we will review this as soon as possible.

@component('mail::panel')
## Information about you
- Name: {{ $revisionRequest->technicianLastName }}, {{ $revisionRequest->technicianFirstName }}
- E-mail: {{ $revisionRequest->technicianEmail }}

## Information about the change
- Name: {{ $revisionRequest->name }}
- Category: {{ $revisionRequest->revisionCategory->name }}
- Description: {{ $revisionRequest->description }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
