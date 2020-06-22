@extends('frontend.layout.front')

@section('content')
<section class="banner home-banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card-slider wow fadeInRight" data-wow-delay="0.4s">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('storage/storage/uploads/banner-02.jpg')}}" alt="">
                        <div class="card-img-overlay">
                            <div class="jumbotron bg-default">
                                <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Automovs</h1>
                                <p class="lead wow fadeInLeft" data-wow-delay="0.5s">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </p>
                                <hr class="my-2">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="{{asset('storage/storage/uploads/banner-01.jpg')}}" alt="">
                        <div class="card-img-overlay">
                            <div class="jumbotron bg-default">
                                <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Automovs</h1>
                                <p class="lead wow fadeInLeft" data-wow-delay="0.5s">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </p>
                                <hr class="my-2">
                            </div>
                        </div>
                    </div>
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
                        <li><a href="{{route('vehicles.sort_by', ['all'])}}" class="link sort-link active"><i class="far fa-cars"></i> All</a></li>
                        <li><a href="{{route('vehicles.sort_by', ['4-wheeler'])}}" class="link sort-link"><i class="far fa-car-side"></i> Cars</a></li>
                        <li><a href="{{route('vehicles.sort_by', ['2-wheeler'])}}" class="link sort-link"><i class="far fa-motorcycle"></i> Bikes</a></li>
                        <li class="dropdown">
                            <a class="link dropdown-toggle" href="#" id="dropdownId"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="farse"><i class="far fa-cogs"></i> Services</a>
                            <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownId">
                                @foreach ($service_types as $service_type)
                                <a class="dropdown-item sort-link" href="{{route('services.sort_by_service_type', ['id' => $service_type->id])}}">{{$service_type->name}}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-columns" id="lists">
                @include('frontend.inc.car_card')
            </div>
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
