@if (count($services) > 0)
@foreach ($services as $service)
<div class="card shadow-sm wow fadeInLeft" data-wow-delay="0.2s">
    <a href="{{route('service.show', $service->id)}}">
        <div class="card-img-otr">
            @php
                $images = explode(',', $service->images);
            @endphp
            <img src="{{asset('storage/'.$images[0])}}" class="card-img-top" alt="...">
        </div>
    </a>
    <div class="card-body">
        <a href="{{route('service.show', $service->id)}}"><h5 class="card-title">{{$service->name}}</h5></a>
        <p class="card-text">Price start at <i class="far fa-rupee-sign"></i>
            @php
                $prices = json_decode($service->price);
            @endphp
             {{$prices[0]->price}}
        </p>
        {{-- <ul class="card-deatils">
            <li><i class="far fa-calendar-alt"></i> {{$service->year_bought}}</li>
            <li><i class="far fa-tachometer-alt"></i> {{$service->driven}} Km</li>
            <li><i class="far fa-map-marker-alt"></i> {{$service->city->city_name}}</li>
        </ul> --}}
        <!-- <p class="card-text"><small class="text-muted">Created 3 mins ago</small></p> -->
    </div>
</div>
@endforeach
@else
<p>
    No service available
</p>
@endif
