@component('mail::message')

{{ $data['email'] }} : ( {{ $data['name'] }} ) : Contact With Us

Subject: {{ $data['subject']}}

Message: <p>{{ $data['message']}}</p>

@endcomponent
