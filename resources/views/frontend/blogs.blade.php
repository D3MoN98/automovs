@extends('frontend.layout.front')

@section('content')
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Blogs</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-list mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($blogs) > 0)
                <div class="card-columns">
                    @foreach ($blogs as $blog)
                    <div class="card shadow-sm wow fadeInLeft" data-wow-delay="0.2s">
                        <a href="{{route('blog.show', $blog->id)}}">
                            <div class="card-img-otr">
                                @php
                                $images = explode(',', $blog->images);
                                @endphp
                                <img src="{{asset('storage/'.$images[0])}}" class="card-img-top" alt="...">
                            </div>
                        </a>
                        <div class="card-body">
                            <span class="badge badge-primary float-right">{{$blog->blog_category->name}}</span>
                            <a href="{{route('blog.show', $blog->id)}}">
                                <h5 class="card-title">{{$blog->title}}</h5>
                            </a>
                            <p class="card-text">{{ Str::words($blog->excerpt,$words = 10, $end='...') }}</p>
                            <p class="card-text d-flex justify-content-between"><small
                                    class="text-muted">{{$blog->user->name}}</small> <small
                                    class="text-muted">{{$blog->created_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{ $blogs->links() }}
                </div>
                @else
                <p class="no-blog">
                    No blog available
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
