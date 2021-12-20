@component('mail::message')
# {{ __('Revision request refused') }}
{{ __('Hey') }} {{ $revisionRequest->technicianFirstName }},

{{ __("We're sad to inform you that your revision request was refused.") }}

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
