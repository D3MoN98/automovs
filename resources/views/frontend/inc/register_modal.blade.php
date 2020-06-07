

<!-- Modal -->
<div class="modal fade" id="register-model" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="regForm" action="{{route('register_action')}}" method="POST" class="reg-form shadow-sm wow fadeInRight" data-wow-delay="0.5s">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title cmn-hdr">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
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
                        <input type="text" name="name" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="contact_no" class="form-control" placeholder="Your Contact No">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Your Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <button type="rest" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#regForm', function(e){
        e.preventDefault();
        var _this = $(this);
        var form = _this.serialize();

        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            dataType: 'json',
            data: form,
            success:function(data){
                _this.find('.form-text.text-danger').remove();
                _this.find('.alert-success').removeClass('d-none');
                _this.trigger("reset");
            },
            error:function(data){
                _this.find('.form-text.text-danger').remove();
                $.each(data.responseJSON.errors, function (i, error) {
                    console.log(i);
                    var el = _this.find('[name="'+i+'"]');
                    el.after($('<small class="form-text text-danger">'+error[0]+'</small>'));
                });
            }
        })
    })
</script>
