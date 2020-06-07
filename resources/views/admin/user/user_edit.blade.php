@extends('admin.layout.dashboard')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit User
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="form-horizontal" role="form" action="{{route('admin.user.update', $user->id)}}" method="POST">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 col-sm-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" value="{{$user->name}}" name="name" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('email') ? 'has-error' : ''}}">
                            <label for="inputEmail" class="col-lg-2 col-sm-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" id="inputEmail" value="{{$user->email}}" name="email" placeholder="Email" required>
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@push('scripts')

@endpush
