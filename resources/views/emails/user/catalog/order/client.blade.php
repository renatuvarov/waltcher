@component('mail::message')

Dear <b>{{ $name }}</b>,

Thank You for contacting to our company.

Expect feedback on the provided contact details.

{{ $text }}

Best regards,
<b>Waltcher team</b>

@endcomponent
