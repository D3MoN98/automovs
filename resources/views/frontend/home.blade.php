@extends('frontend.layout.front')

@section('content')
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Jumbo heading</h1>
                    <p class="lead wow fadeInLeft" data-wow-delay="0.5s">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia magnam,
                        perspiciatis temporibus porro, repellat iste saepe ullam consequuntur, inventore fuga soluta
                        eius beatae assumenda nesciunt veritatis autem cumque iure.
                    </p>
                    <hr class="my-2">
                    <p class="lead wow fadeInLeft" data-wow-delay="0.5s">
                        <a class="btn btn-primary" href="Jumbo action link" role="button">Jumbo action name</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 reg-form-otr">
                {{-- <form action="" class="reg-form shadow-sm wow fadeInRight" data-wow-delay="0.5s">
                    <h2 class="form-heading">Register Now</h2>
                    <p class="form-sub-heading">Book instantly!</p>
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Your Name"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Your Email"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="text" name="" id="" class="form-control" placeholder="Your Contact No"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="password" name="" id="" class="form-control" placeholder="Your Password"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="password" name="" id="" class="form-control" placeholder="Confirm Your Password"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <button type="button" name="" id="" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</section>


<section class="car-list mt-5">
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
        <div class="row mt-5">
            <div class="card-columns" id="lists">
                @include('frontend.inc.car_card')
            </div>
        </div>
        {{-- <div class="row mt-5">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary">Load More</button>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div> --}}
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
@endpush
