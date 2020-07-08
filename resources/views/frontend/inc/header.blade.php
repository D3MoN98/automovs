<section class="header bg-default">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <nav class="navbar navbar-expand-sm">
                        <a class="navbar-brand" href="{{route('home')}}"><img
                                src="{{asset('frontend/images/page_logo.png')}}" alt="" width="150"
                                class="d-inline-block align-top" alt=""></a>
                        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                            data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="farse"
                            aria-label="Toggle navigation">
                            {{-- <span class="navbar-toggler-icon"></span> --}}
                            <i class="far fa-bars" aria-hidden="true"></i>
                        </button>
                        <div class="collapse navbar-collapse ml-auto" id="collapsibleNavId">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('home')}}">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
                                </li>
                                @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('vehicle.create')}}">Add Vehicle</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('profile')}}">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#" type="button" data-toggle="modal"
                                        data-target="#login-model">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" type="button" data-toggle="modal"
                                        data-target="#register-model">Register</a>
                                </li>
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>
</section>
