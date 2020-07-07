@component('mail::message')
# Service Booked

Hello, {{$service_book->user->name}}

Your book for service has been placed successfully. Service center will contact you shortly. Here's your invoice.


@component('mail::button', ['url' => route('service.show', $service_book->service->id)])
View Service
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
