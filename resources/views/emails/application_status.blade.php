@component('mail::message')
# Application Status Update

The following application has been **{{ ucfirst($application->status) }}** by the Dean.

**Applicant Details:**
- Name: {{ $applicant->name }}
- Faculty: {{ $applicant->faculty }}
- Department: {{ $applicant->department }}
- Contact: {{ $applicant->contact_no }}

**Application Details:**
- Purpose: {{ $application->purpose }}
- From: {{ $application->from_location }}
- To: {{ $application->to_location }}
- Departure Date: {{ $application->departure_date }}
- Return Date: {{ $application->return_date }}

**Approved by:** {{ $dean->name }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
