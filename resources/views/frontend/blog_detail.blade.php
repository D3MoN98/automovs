@extends('frontend.layout.front')

@section('content')
<section class="banner blog-detail-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3 class="display-4">{{$blog->title}}</h3>
                    <p class="lead text-primary">By {{$blog->user->name}}, {{$blog->created_at->diffForHumans()}} <span
                            class="badge badge-primary float-right">{{$blog->blog_category->name}}</span></p>
                </div>
                <div class="card">
                    @php
                    $images = explode(',', $blog->images);
                    @endphp
                    <img class="card-img" src="{{asset('storage/'.$images[0])}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $blog->content !!}
            </div>
        </div>
    </div>
</section>

@endsection
