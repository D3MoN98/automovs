@extends('invoice.invoice_layout')

@section('content')

<header class="clearfix">
    <div id="logo">
        <img src="{{ public_path('/frontend/images/page_logo.png')  }}">
    </div>
    <h1>INVOICE</h1>
    <div id="project">
        <div><span>Customer</span> {{$service_book->user->name}}</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>Contact No</span> <a
                href="tel:{{$service_book->user->contact_no}}">{{$service_book->user->contact_no}}</a></div>
        <div><span>EMAIL</span> <a href="mailto:{{$service_book->user->email}}">{{$service_book->user->email}}</a></div>
        <div><span>DATE</span> {{date('F d, Y', strtotime($service_book->created_at))}}</div>
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
                <td class="service">Service Booking</td>
                <td class="desc">{{$service_book->service->name}}</td>
                <td class="unit">Rs. {{$service_book->payment->amount}}</td>
                <td class="qty">1</td>
                <td class="total">Rs. {{$service_book->payment->amount}}</td>
            </tr>
        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
</main>

@endsection
