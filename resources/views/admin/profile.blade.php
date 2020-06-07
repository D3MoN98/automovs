@extends('admin.layout.dashboard')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Profile Info
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="form-horizontal" role="form" action="{{route('admin.profile')}}" method="POST">
                        @csrf


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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Password
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="form-horizontal" role="form" action="{{route('admin.password.update')}}" method="POST">
                        @csrf

                        <div class="form-group {{ $errors->first('current_password') ? 'has-error' : ''}}">
                            <label for="inputCurrentPassword" class="col-lg-2 col-sm-2 control-label">Current Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputCurrentPassword" name="current_password" placeholder="Current Password">
                                <p class="help-block">{{ $errors->first('current_password') }}</p>

                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('new_password') ? 'has-error' : ''}}">
                            <label for="inputNewPassword" class="col-lg-2 col-sm-2 control-label">New Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputNewPassword" name="new_password" placeholder="New Password">
                                <p class="help-block">{{ $errors->first('new_password') }}</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputConfirmPassword" class="col-lg-2 col-sm-2 control-label">Confirm Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputConfirmPassword" name="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update</button>
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
