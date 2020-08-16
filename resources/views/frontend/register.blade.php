@extends('frontend.layout.front')

@section('content')
<style>
    .btn.btn-secondary {
        background-color: #5c2626 !important;
        color: #fff5da;
        border: 1px solid transparent;
    }
</style>
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Register</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form id="regForm" action="{{route('register_action')}}" method="POST"
                class="reg-form shadow-sm wow fadeInDown" data-wow-delay="0.5s">
                @csrf
                <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Register Successfull</strong>
                </div>

                <script>
                    $(".alert").alert();
                </script>

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="contact_no" class="form-control" placeholder="Your Contact No" required>
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="Your Address" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Your Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control"
                        placeholder="Confirm Your Password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-submit">Sign Up
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    <button type="rest" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).on('submit', '#regForm', function(e){
        e.preventDefault();
        var _this = $(this);
        var form = _this.serialize();

        var btn = _this.find('.btn-submit');
        btn.attr('disabled', 'disabled');
        btn.find('.spinner-border').removeClass('d-none');

        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            dataType: 'json',
            data: form,
            success:function(data){
                _this.find('.form-text.text-danger').remove();
                _this.find('.alert-success').removeClass('d-none');
                _this.trigger("reset");
                btn.removeAttr('disabled');
                btn.find('.spinner-border').addClass('d-none');
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
            },
            error:function(data){
                _this.find('.form-text.text-danger').remove();
                btn.removeAttr('disabled');
                btn.find('.spinner-border').addClass('d-none');
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
