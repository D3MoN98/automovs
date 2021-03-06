@extends('invoice.invoice_layout')

@section('content')

<header class="clearfix">
    <div id="logo">
        <img src="{{ public_path('/frontend/images/page_logo.png')  }}">
    </div>
    <h1>INVOICE</h1>
    <div id="project">
        <div><span>Customer</span> {{$vehicle_book->user->name}}</div>
        <div><span>ADDRESS</span> {{$vehicle_book->user->address}}</div>
        <div><span>Contact No</span> <a
                href="tel:{{$vehicle_book->user->contact_no}}">{{$vehicle_book->user->contact_no}}</a></div>
        <div><span>EMAIL</span> <a href="mailto:{{$vehicle_book->user->email}}">{{$vehicle_book->user->email}}</a></div>
        <div><span>DATE</span> {{date('F d, Y', strtotime($vehicle_book->created_at))}}</div>
    </div>
    @include('invoice.invoice_comp')
</header>
<main>
    <table>
        <thead>
            <tr>
                <th class="service">SERVICE</th>
                <th class="desc">DESCRIPTION</th>
                <th>PRICE</th>
                <th>QTY</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="service">Vehicle Booking</td>
                <td class="desc">{{$vehicle_book->vehicle->brand . ' ' . $vehicle_book->vehicle->model}}</td>
                <td class="unit">Rs. {{$vehicle_book->payment->amount}}</td>
                <td class="qty">1</td>
                <td class="total">Rs. {{$vehicle_book->payment->amount}}</td>
            </tr>
        </tbody>
    </table>
    {{-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div> --}}
</main>

@endsection
