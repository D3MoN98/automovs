@extends('frontend.layout.front')

@section('content')

    <section class="single-details-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item link" href="{{url('/')}}">Home</a>
                        <a class="breadcrumb-item link" href="#">Car</a>
                        <span class="breadcrumb-item active">{{$vehicle->brand}} - {{$vehicle->model}}</span>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 single-img-otr wow fadeInLeft" data-wow-delay="0.5s">
                    @php
                        $images = explode(',', $vehicle->images);
                    @endphp

                    <div class="slider-img">
                        @foreach ($images as $image)
                        <div class="card shadow-sm">
                            <a href="{{asset('storage/'.$image)}}" data-fancybox="gallery" href="big_1.jpg">
                                <img class="card-img-top single-img" src="{{asset('storage/'.$image)}}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="slider-img-nav">
                        @foreach ($images as $image)
                        <div class="card shadow-sm">
                            <img class="card-img-top single-img" src="{{asset('storage/'.$image)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="sngl-hdr wow fadeInRight" data-wow-delay="0.5s">{{$vehicle->brand}} - {{$vehicle->model}}</h3>
                    <div class="price-otr mt-3 wow fadeInRight" data-wow-delay="0.6s"><i class="far fa-rupee-sign"></i> {{$vehicle->price}}</div>
                    <div class="attribute-otr mt-4 wow fadeInRight" data-wow-delay="0.7s">
                        <ul class="attribute-list">
                            <li><span>Band</span> <span>{{$vehicle->brand}}</span></li>
                            <li><span>Model</span> <span>{{$vehicle->model}}</span></li>
                            <li><span>Variant</span> <span>{{$vehicle->variant}}</span></li>
                            <li><span>Body Colour</span> <span>{{$vehicle->color}}</span></li>
                            <li><span>Reg num</span> <span>{{$vehicle->registration_number}}</span></li>
                            <li><span>Kms Driven</span> <span>{{$vehicle->driven}}</span></li>
                            <li><span>Year bought</span> <span>{{$vehicle->year_bought}}</span></li>
                            <li><span>Insurance till</span> <span>{{$vehicle->insurance}}</span></li>
                            <li><span>Location</span> <span>{{$vehicle->city->city_name}}</span></li>
                        </ul>
                    </div>
                    <div class="ettra-info wow fadeInRight" data-wow-delay="0.8s">
                        <p>{{$vehicle->description}}</p>
                    </div>
                    <div class="action-otr wow fadeInRight"  data-wow-delay="1s">
                        @auth
                            @if (!Auth::user()->hasVehicle($vehicle->id))
                                @if(Auth::user()->hasVehiclePurchased($vehicle->id))
                                    <button type="submit" class="btn btn-primary">Vehicle Purchased</button>
                                @elseif (!Auth::user()->hasVehicleBooked($vehicle->id))
                                <form action="{{route('pay', ['for' => 'vehicle', 'type' => 'booking', 'id' => $vehicle->id ])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Order Now</button>
                                </form>
                                @elseif(Auth::user()->hasVehicleBooked($vehicle->id))
                                <form action="{{route('pay', ['for' => 'vehicle', 'type' => 'purchase', 'id' => $vehicle->id ])}}" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-primary">Vehicle is verified</button>
                                    <button type="submit" class="btn btn-primary">Buy Now</button>
                                </form>
                                @endif
                            @endif
                        @else
                        <button class="btn btn-primary" href="#" type="button" data-toggle="modal" data-target="#login-model">Book</button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="car-list">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="cmn-hdr">Related Collection</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="related-list-otr">
                        @foreach ($vehicles as $vehicle)
                        <div class="card shadow-sm wow fadeInLeft" data-wow-delay="0.2s">
                            <a href="{{route('vehicle.show', $vehicle->id)}}">
                                <div class="card-img-otr">
                                    @php
                                        $images = explode(',', $vehicle->images);
                                    @endphp
                                    <img src="{{asset('storage/'.$images[0])}}" class="card-img-top" alt="...">
                                </div>
                            </a>
                            <div class="card-body">
                                <a href=""><h5 class="card-title">{{$vehicle->brand}} - {{$vehicle->model}}</h5></a>
                                <p class="card-text">Price <i class="far fa-rupee-sign"></i> {{$vehicle->price}}</p>
                                <ul class="card-deatils">
                                    <li><i class="far fa-calendar-alt"></i> {{$vehicle->year_bought}}</li>
                                    <li><i class="far fa-tachometer-alt"></i> {{$vehicle->driven}} Km</li>
                                    <li><i class="far fa-map-marker-alt"></i> {{$vehicle->city->city_name}}</li>
                                </ul>
                                <!-- <p class="card-text"><small class="text-muted">Created 3 mins ago</small></p> -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <script>
        $('.slider-img').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            centerMode: false,
            asNavFor: '.slider-img-nav'
        });
        $('.slider-img-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-img',
            dots: false,
            arrows: false,
            centerMode: false,
            focusOnSelect: true
        });
        $('.related-list-otr').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            centerMode: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1008,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $(window).resize(function () {
            $('.related-list-otr').not('.slick-initialized').slick('resize');
        });

        $(window).on('orientationchange', function () {
            $('.related-list-otr').not('.slick-initialized').slick('resize');
        });
    </script>
@endpush
