@component('mail::message')
# Vehicle Purchased

Hello, {{$vehicle_purchase->user->name}}

You have purchased the car successfully. Here's your invoice.

@component('mail::button', ['url' => route('vehicle.show', $vehicle_purchase->vehicle->id)])
View Vehicle
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
