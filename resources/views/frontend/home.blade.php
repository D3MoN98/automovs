@extends('frontend.layout.front')

@section('content')

<section class="banner home-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card-slider wow fadeInRight" data-wow-delay="0.4s">
                    <a href="{{route('register')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/banner-02.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Register to sell or buy a
                                        car now</h1>
                                    <hr class="my-2">
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{route('services')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/banner-01.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Get Your Car Services
                                        Done Now</h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use
                                            Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/1')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-wash-detailing.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car wash and detailing
                                    </h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/3')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-sanitizing.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car interior sanitization
                                    </h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/4')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-services.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car services</h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/5')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-general-service.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car general services</h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/11/single')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/corrosion-protectoin.png')}}"
                                alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Underbody rust protection
                                    </h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/10/single')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-denting-painting.jpeg')}}"
                                alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car denting painting</h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{url('service_type/12/single')}}">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('frontend/images/car-ac-service.jpg')}}" alt="">
                            <div class="card-img-overlay">
                                <div class="jumbotron bg-default">
                                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Car ac services and gas
                                        charge
                                    </h1>
                                    <hr class="my-2">
                                    <p>
                                        <span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Flat 20%
                                            off</span>
                                    </p>
                                    <p><span class="badge badge-primary wow fadeInRight" data-wow-delay="0.5s">Use Code
                                            - AUTOMOVS20</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="car-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="cmn-hdr">Featured Collection</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-otr">
                    <ul class="tab-ul">
                        <li><a href="{{route('vehicles.sort_by', ['all'])}}" class="link sort-link active"><i
                                    class="far fa-cars"></i> All</a></li>
                        <li><a href="{{route('vehicles.sort_by', ['4-wheeler'])}}" class="link sort-link"><i
                                    class="far fa-car-side"></i> Cars</a></li>
                        <li><a href="{{route('vehicles.sort_by', ['2-wheeler'])}}" class="link sort-link"><i
                                    class="far fa-motorcycle"></i> Bikes</a></li>
                        <li class="dropdown">
                            <a class="link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="farse"><i class="far fa-cogs"></i> Services</a>
                            <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownId">
                                @foreach ($service_types as $service_type)
                                <a class="dropdown-item sort-link"
                                    href="{{route('services.sort_by_service_type', ['id' => $service_type->id])}}">{{$service_type->name}}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row car-column" id="lists">
            @include('frontend.inc.car_card')
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.sort-link', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var _this = $(this);
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success:function(data){
                _this.closest('.tab-ul').find('.link').removeClass('active');
                _this.closest('li').find('.link').addClass('active');
                $('#lists').html(data.html);
            }
        })
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
    $('.card-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        centerMode: false,
        focusOnSelect: true,
    });
</script>
@endpush
