@extends('frontend.layout.front')

@section('content')
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Services</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="car-list mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($services) > 0)
                <div class="card-columns">
                    @include('frontend.inc.service_card')
                </div>
                <div>
                    {{ $services->links() }}
                </div>
                @else
                <p class="no-blog">
                    No Services available
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
