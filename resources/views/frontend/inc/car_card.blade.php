@php
$i = 0.2;
@endphp
@foreach ($vehicles as $vehicle)
<div class="col-md-4">
    <div class="card shadow-sm wow fadeInLeft" data-wow-delay="{{$i}}s">
        @if ($vehicle->isPuchased())
        <div class="cr cr-top cr-left">Sold Out</div>
        @else
        @auth
        @if (Auth::user()->isLastVehicleBookedExpired($vehicle->id))
        <div class="cr cr-top cr-left bg-primary"><i class="far fa-badge-check"></i> Verified</div>
        @endif
        @endauth
        @endif
        <a href="{{route('vehicle.show', $vehicle->id)}}">
            <div class="card-img-otr">
                @php
                $images = explode(',', $vehicle->images);
                @endphp
                <img src="{{asset('storage/'.$images[0])}}" class="card-img-top" alt="...">
            </div>
        </a>
        <div class="card-body">
            <a href="{{route('vehicle.show', $vehicle->id)}}">
                <h5 class="card-title">{{$vehicle->brand}} - {{$vehicle->model}}</h5>
            </a>
            <p class="card-text">Price <i class="far fa-rupee-sign"></i> {{$vehicle->price}}</p>
            <ul class="card-deatils">
                <li><i class="far fa-calendar-alt"></i> {{$vehicle->year_bought}}</li>
                <li><i class="far fa-tachometer-alt"></i> {{$vehicle->driven}} Km</li>
                <li><i class="far fa-map-marker-alt"></i> {{$vehicle->city->city_name}}</li>
            </ul>
            <!-- <p class="card-text"><small class="text-muted">Created 3 mins ago</small></p> -->
        </div>
    </div>
</div>
@php
$i+=0.2;
@endphp
@endforeach
