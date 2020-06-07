@extends('admin.layout.minimal')

@section('content')
<div class="container">

    <form class="form-signin" action="{{route('admin.login_action')}}" method="POST">
        @csrf
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                @if ($errors->first('error'))
                <div class="alert alert-danger text-center">
                    <strong>{{$errors->first('error')}}</strong>
                </div>
                @endif
                <input type="text" class="form-control {{ $errors->first('user.email') ? 'is-invalid' : ''}}" name="user[email]" value="{{ $errors->first('email') }}" placeholder="Email" autofocus  id="email"  autocomplete="off" required >
                <span class="invalid-feedback">{{($errors->first('user.email'))}}</span>
                <input type="password" class="form-control {{ $errors->first('user.password') ? 'is-invalid' : ''}}" placeholder="Password"  id="password" name="user[password]" required value="">
                <span class="invalid-feedback">{{($errors->first('user.password'))}}</span>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me" name="remember" > Remember me
                {{-- <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span> --}}
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>


        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal"
            class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off"
                            class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-success" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>

</div>
@endsection
