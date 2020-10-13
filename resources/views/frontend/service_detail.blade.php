@extends('frontend.layout.front')

@section('content')

<section class="single-details-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item link" href="{{url('/')}}">Home</a>
                    <a class="breadcrumb-item link" href="#">Service</a>
                    <span class="breadcrumb-item active">{{$service->name}}</span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 single-img-otr wow fadeInLeft" data-wow-delay="0.5s">
                @php
                $images = explode(',', $service->images);
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
                <h3 class="sngl-hdr wow fadeInRight" data-wow-delay="0.5s">{{$service->name}} - <small>Service Id
                        {{$service->id}}</small></h3>
                @php
                $prices = json_decode($service->price);
                @endphp
                <div class="price-otr mt-3 wow fadeInRight" data-wow-delay="0.6s">Price start at <i
                        class="far fa-rupee-sign"></i>{{$prices[0]->price}}</div>

                <div class="attribute-otr mt-4 wow fadeInRight" data-wow-delay="0.7s">
                    <ul class="attribute-list">
                        @foreach ($prices as $price)
                        <li><span>{{$price->price_type}}</span> <span><i
                                    class="far fa-rupee-sign"></i>{{$price->price}}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="ettra-info my-2 wow fadeInRight" data-wow-delay="0.8s">
                    <p>{{$service->short_description}}</p>
                </div>

                <div class="ettra-info my-2 wow fadeInRight" data-wow-delay="0.8s">
                    <p>{{$service->long_description}}</p>
                </div>
                <div class="action-otr my-2 wow fadeInRight" data-wow-delay="1s">
                    @auth
                    @foreach ($prices as $price)
                    <form action="{{route('pay', ['for' => 'service', 'type' => 'booking', 'id' => $service->id ])}}"
                        method="post">
                        @csrf
                        <input type="hidden" name="amount" value="{{$price->price}}">
                        <button type="submit" class="btn btn-primary">Book <i
                                class="far fa-rupee-sign"></i>{{$price->price}}</button>
                        <input type="hidden" name="coupon" value="0">
                    </form>
                    @endforeach

                    @else
                    <button class="btn btn-primary" href="#" type="button" data-toggle="modal"
                        data-target="#login-model">Book</button>
                    @endauth
                </div>
                @auth
                <div class="input-group mt-3" style="width: 75%">
                    <input type="text" class="form-control coupon-input" placeholder="Apply Coupon Code"
                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary apply-coupon" type="button"
                            id="button-addon1">Apply</button>
                    </div>
                    <div class="invalid-feedback">
                        Invalid coupon code.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</section>


<section class="car-list mt-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="cmn-hdr">Related Collection</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="related-list-otr">
                    @include('frontend.inc.service_card')
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
            asNavFor: '.slider-img-nav'
        });
        $('.slider-img-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-img',
            dots: false,
            arrows: false,
            focusOnSelect: true
        });
        $('.related-list-otr').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: false,
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
</script>

<script>
    $(document).on('click', '.apply-coupon', function(){
        $('.coupon-input').removeClass('is-invalid');
        var coupon = $('.coupon-input').val();
        $.ajax({
            url: '{{route("coupon.check")}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "coupon": coupon
            },
            dataType: 'json',
            success:function(data){
                if(data.error){
                    $('.coupon-input').addClass('is-invalid');
                    $('input[name="coupon"]').val(0);
                } else if(data.success){
                    $('.coupon-input').removeClass('is-invalid');
                    $('.coupon-input').addClass('is-valid');
                    $('.valid-feedback').html(data.data.description);
                    $('input[name="coupon"]').val(data.data.id);
                    $('.apply-coupon').addClass('coupon-applied');
                    $('.coupon-applied').removeClass('apply-coupon');
                    $('.coupon-applied').html('Coupon Applied');
                    $('.coupon-input').attr('disabled', 'disabled');
                }


            }
        })
    });

    $(document).on('click', '.coupon-applied', function(){
        $('input[name="coupon"]').val(0);
        $('.coupon-applied').addClass('apply-coupon');
        $('.apply-coupon').removeClass('coupon-applied');
        $('.apply-coupon').html('Apply');
        $('.coupon-input').removeAttr('disabled');
        $('.coupon-input').removeClass('is-valid');
    });

    $(document).on('mouseover', '.coupon-applied', function(){
        $(this).html('Remove Coupon');
    });

    $(document).on('mouseleave', '.coupon-applied', function(){
        $(this).html('Coupon Applied');
    });
</script>
@endpush
