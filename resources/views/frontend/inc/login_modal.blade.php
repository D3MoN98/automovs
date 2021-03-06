    <!-- Modal -->
    <div class="modal fade" id="login-model" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="loginForm" class="reg-form shadow-sm" action="{{route('login_action')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title cmn-hdr">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                            <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Login Successfull</strong>
                            </div>

                            <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Credentials not matched</strong>
                            </div>

                            <script>
                                $(".alert").alert();
                            </script>

                            <div class="form-group">
                                <input type="text" name="email" id="" class="form-control" placeholder="Your Email"
                                    aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="" class="form-control" placeholder="Your Password"
                                    aria-describedby="helpId">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-submit">Login
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('submit', '#loginForm', function(e){
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
                    _this.find('.alert-danger').addClass('d-none');
                    _this.find('.alert-success').removeClass('d-none');
                    _this.trigger("reset");
                    btn.removeAttr('disabled');
                    btn.find('.spinner-border').addClass('d-none');


                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error:function(data){
                    btn.removeAttr('disabled');
                    btn.find('.spinner-border').addClass('d-none');
                    if (data.status === 422) {
                        _this.find('.form-text.text-danger').remove();
                        $.each(data.responseJSON.errors, function (i, error) {
                            console.log(i);
                            var el = _this.find('[name="'+i+'"]');
                            el.after($('<small class="form-text text-danger">'+error[0]+'</small>'));
                        });
                    } else if(data.status === 401) {
                        _this.find('.form-text.text-danger').remove();
                        _this.find('.alert-danger').removeClass('d-none');
                        _this.trigger("reset");

                    }
                }
            })
        })
    </script>
