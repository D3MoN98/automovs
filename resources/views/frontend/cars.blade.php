@extends('frontend.layout.front')

@section('content')
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Cars</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="car-list mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($vehicles) > 0)
                <div class="card-columns">
                    @include('frontend.inc.car_card')
                </div>
                <div>
                    {{ $vehicles->links() }}
                </div>
                @else
                <p class="no-blog">
                    No Cars available
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
