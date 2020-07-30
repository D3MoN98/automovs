@component('mail::message')
# Vehicle Booked

Hello,

Your order for verification has been placed. The car will be shown verified for 15 days. Please make your purchase
within that time.

@component('mail::button', ['url' => '/'])
View Vehicle
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
