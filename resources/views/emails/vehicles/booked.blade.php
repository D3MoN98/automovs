@component('mail::message')
# Vehicle Booked

Hello, {{$vehicle_book->user->name}}

Your order for verification has been placed. The car will be shown verified for 15 days. Please make your purchase
within that time.

@component('mail::button', ['url' => route('vehicle.show', $vehicle_book->vehicle->id)])
View Vehicle
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
