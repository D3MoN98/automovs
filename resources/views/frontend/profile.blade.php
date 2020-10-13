@php
// foreach ($user->vehicleBooks as $key) {
// print_r($key->vehicle->images);
// }die;
@endphp
@extends('frontend.layout.front')

@section('content')
<style>
    .btn.btn-secondary {
        background-color: #5c2626 !important;
        color: #fff5da;
        border: 1px solid transparent;
    }

    .input-group-text {
        background: transparent;
        border: 1px solid #5c2626;
        color: #5c2626;
    }
</style>
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Profile</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 tab-otr">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                        role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile Details</a>
                    <a class="nav-link" id="v-pills-ps-chng-tab" data-toggle="pill" href="#v-pills-ps-chng" role="tab"
                        aria-controls="v-pills-ps-chng" aria-selected="false">Change Password</a>
                    <a class="nav-link" id="v-pills-books-tab" data-toggle="pill" href="#v-pills-books" role="tab"
                        aria-controls="v-pills-books" aria-selected="false">Vehicle Bookings</a>
                    <a class="nav-link" id="v-pills-ser-books-tab" data-toggle="pill" href="#v-pills-ser-books"
                        role="tab" aria-controls="v-pills-ser-books" aria-selected="false">Service Bookings</a>
                    <a class="nav-link" id="v-pills-veh-pur-tab" data-toggle="pill" href="#v-pills-veh-pur" role="tab"
                        aria-controls="v-pills-veh-pur" aria-selected="false">Vehicle Purchases</a>
                    {{-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">Settings</a> --}}
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <form id="profileForm" action="{{route('profile.update', $user->id)}}" method="POST">
                            @csrf

                            <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Profile Updated</strong>
                            </div>

                            <script>
                                $(".alert").alert();
                            </script>

                            <div class="form-group">
                                <input type="text" name="name" value="{{$user->name}}" class="form-control"
                                    placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" value="{{$user->email}}" class="form-control"
                                    placeholder="Your Email">
                            </div>
                            {{-- <div class="form-group">
                                <input type="tel" name="contact_no" value="{{$user->contact_no}}" class="form-control"
                            placeholder="Your Contact No">
                    </div> --}}

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">+91</span>
                            </div>
                            <input type="tel" name="contact_no" class="form-control"
                                value="{{substr($user->contact_no, 2)}}" placeholder="Your Contact No" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="{{$user->address}}" class="form-control"
                            placeholder="Your Address">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-ps-chng" role="tabpanel" aria-labelledby="v-pills-ps-chng-tab">
                    <form id="passForm" action="{{route('profile.update.passsword', $user->id)}}" method="POST">
                        @csrf

                        <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Password Updated</strong>
                        </div>

                        <script>
                            $(".alert").alert();
                        </script>

                        <div class="form-group">
                            <input type="password" name="current_password" class="form-control"
                                placeholder="Current Password">
                        </div>

                        <div class="form-group">
                            <input type="password" name="new_password" class="form-control" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirm Password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-books" role="tabpanel" aria-labelledby="v-pills-books-tab">
                    <ul class="list-group">
                        @foreach ($user->vehicleBooks as $vehicle_book)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="img-otr">
                                        <a href="{{route('vehicle.show', $vehicle_book->vehicle_id)}}">
                                            <img src="{{asset('storage/'.explode(',', $vehicle_book->vehicle->images)[0])}}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-6">
                                    <h4><a
                                            href="{{route('vehicle.show', $vehicle_book->vehicle_id)}}">{{$vehicle_book->vehicle->brand. ' ' . $vehicle_book->model}}</a>
                                    </h4>
                                    <p>Seller: {{$vehicle_book->vehicle->user->name}}</p>
                                </div>
                                <div class="col-md-4 col-sm-12 list-right">
                                    <small class="text-muted">Booked on
                                        {{date('D, M d, Y, h:i a', strtotime($vehicle_book->created_at))}}</small>
                                    <div>
                                        <span
                                            class="badge badge-{{$vehicle_book->is_verified == 1 ? 'success' : 'danger'}}"><i
                                                class="far fa-badge-check"></i>
                                            {{$vehicle_book->is_verified == 1 ? 'verified' : 'not verified'}}</span>
                                    </div>
                                    <p>Total Paid: <i class="far fa-rupee-sign    "></i>
                                        {{$vehicle_book->payment->amount}}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="v-pills-ser-books" role="tabpanel"
                    aria-labelledby="v-pills-ser-books-tab">
                    <ul class="list-group">
                        @foreach ($user->serviceBooks as $service_book)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="img-otr">
                                        <a href="{{route('service.show', $service_book->service_id)}}">
                                            <img src="{{asset('storage/'.explode(',', $service_book->service->images)[0])}}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h4><a
                                            href="{{route('service.show', $service_book->service_id)}}">{{$service_book->service->name}}</a>
                                    </h4>
                                </div>
                                <div class="col-4 list-right">
                                    <small class="text-muted">Booked on
                                        {{date('D, M d, Y, h:i a', strtotime($service_book->created_at))}}</small>
                                    <p>Total Paid: <i class="far fa-rupee-sign    "></i>
                                        {{$service_book->payment->amount}}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="v-pills-veh-pur" role="tabpanel" aria-labelledby="v-pills-veh-pur-tab">
                    <ul class="list-group">
                        @foreach ($user->vehiclePurchases as $vehicle_purchase)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="img-otr">
                                        <a href="{{route('vehicle.show', $vehicle_purchase->vehicle_id)}}">
                                            <img src="{{asset('storage/'.explode(',', $vehicle_purchase->vehicle->images)[0])}}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h4><a
                                            href="{{route('vehicle.show', $vehicle_purchase->vehicle_id)}}">{{$vehicle_purchase->vehicle->brand. ' ' . $vehicle_purchase->model}}</a>
                                    </h4>
                                    <p>Seller: {{$vehicle_purchase->vehicle->user->name}}</p>
                                </div>
                                <div class="col-4 list-right">
                                    <small class="text-muted">Booked on
                                        {{date('D, M d, Y, h:i a', strtotime($vehicle_purchase->created_at))}}</small>
                                    {{-- <span
                                            class="badge badge-{{$vehicle_purchase->is_verified == 1 ? 'success' : 'danger'}}">{{$vehicle_purchase->is_verified == 1 ? 'verified' : 'not verified'}}</span>
                                    --}}
                                    <p>Total Paid: <i class="far fa-rupee-sign    "></i>
                                        {{$vehicle_purchase->payment->amount}}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">
                        ...
                    </div> --}}
            </div>
        </div>
    </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).on('submit', '#profileForm', function(e){
        e.preventDefault();
        var _this = $(this);
        var form = _this.serialize();

        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            dataType: 'json',
            data: form,
            success:function(data){
                _this.find('.form-text.text-danger').remove();
                _this.find('.alert-success').removeClass('d-none');
                // _this.trigger("reset");
            },
            error:function(data){
                _this.find('.form-text.text-danger').remove();
                $.each(data.responseJSON.errors, function (i, error) {
                    console.log(i);
                    var el = _this.find('[name="'+i+'"]');
                    el.after($('<small class="form-text text-danger">'+error[0]+'</small>'));
                });
            }
        })
    })

    $(document).on('submit', '#passForm', function(e){
        e.preventDefault();
        var _this = $(this);
        var form = _this.serialize();

        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            dataType: 'json',
            data: form,
            success:function(data){
                _this.find('.form-text.text-danger').remove();
                _this.find('.alert-success').removeClass('d-none');
                _this.trigger("reset");
            },
            error:function(data){
                _this.find('.form-text.text-danger').remove();
                $.each(data.responseJSON.errors, function (i, error) {
                    console.log(i);
                    var el = _this.find('[name="'+i+'"]');
                    el.after($('<small class="form-text text-danger">'+error[0]+'</small>'));
                });
            }
        })
    })
</script>
@endpush
