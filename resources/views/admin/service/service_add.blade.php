@extends('admin.layout.dashboard')

@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('backend/js/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
<style>
    .fileupload-preview img.img-thumbnail {
        max-width: 135px !important;
        margin-right: 5px !important;
    }
    .price-otr{
        display: flex;
        justify-content: flex-start !important;
        margin-bottom: 10px;
    }
    .flex-end{
        justify-content: flex-end !important;
    }
    .price-remove{
        padding: 8px;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Service
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="cmxform form-horizontal"  id="serviceForm" role="form" action="{{route('admin.service.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="name" minlength="2" name="service[name]" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="col-lg-2 col-sm-2 control-label">Short Description</label>
                            <div class="col-lg-10">
                                <textarea  class="form-control" id="short_description" name="service[short_description]" placeholder="Short Description" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="long_description" class="col-lg-2 col-sm-2 control-label">Long Description</label>
                            <div class="col-lg-10">
                                <textarea  class="form-control" id="long_description" rows="8" name="service[long_description]" placeholder="Long Description" required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="service_type" class="col-lg-2 col-sm-2 control-label">Service Type</label>
                            <div class="col-lg-10">
                                <select  class="form-control custom-select2" id="service_type" name="service[service_type_id]" required>
                                    <option value=""></option>
                                    @foreach ($service_types as $service_type)
                                    <option value="{{$service_type->id}}">{{$service_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group price-otr">
                            <label for="price" class="col-lg-2 col-sm-2 control-label">Price</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control price_type-inp" id="price" name="price[0][price_type]" placeholder="Price Type" required>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control price-inp" id="price" name="price[0][price]" placeholder="Price" required>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-secondary add-price">Add Another</button>
                        </div>


                        <div class="form-group last">
                            <label class="control-label col-md-2">Image Upload</label>
                            <div class="col-md-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input id="file" type="file" name="service_file[]" class="default" multiple required/>
                                        </span>
                                        <a href="#" class="btn btn-danger remove-fileupload fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                <span class="label label-danger">NOTE!</span> <span>You can upload maximum 5 images</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Create</button>
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
<script type="text/javascript" src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
<script>
    $("#serviceForm").validate({
     highlight: function (element, errorClass, validClass) {
       var elem = $(element);
       if (elem.hasClass("select2-hidden-accessible")) {
           $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
       } else {
           elem.addClass(errorClass);
       }
     },
     unhighlight: function (element, errorClass, validClass) {
         var elem = $(element);
         if (elem.hasClass("select2-hidden-accessible")) {
              $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
         } else {
             elem.removeClass(errorClass);
         }
     },
     errorPlacement: function(error, element) {
       var elem = $(element);
       if (elem.hasClass("select2-hidden-accessible")) {
           element = $("#select2-" + elem.attr("id") + "-container").parent();
           error.insertAfter(element);
       } else {
           error.insertAfter(element);
       }
     }
   });
</script>
{{-- <script src="{{asset('backend/js/validation-init.js')}}"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script>

	$( "select.custom-select2" ).select2( {
		theme: "bootstrap",
		placeholder: "Select a service Type",
		maximumSelectionSize: 6,
		containerCssClass: ':all:'
    } ).on("change", function (e) {
        $(this).valid();
    });

    // $('select').select2({})

</script>
{{-- <script type="text/javascript" src="{{asset('backend/js/bootstrap-fileupload/bootstrap-fileupload.js')}}""></script> --}}
<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).addClass('img-thumbnail').appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#file').on('change', function() {
            $('div.fileupload').toggleClass('fileupload-new fileupload-exists');
            // $('div.fileupload-preview').show();
            $('div.fileupload-preview').html('');
            imagesPreview(this, 'div.fileupload-preview');
            $(this).valid();
        });

        $('.remove-fileupload').on('click', function(e) {
            e.preventDefault();
            $('div.fileupload').removeClass('fileupload-exists');
            $('div.fileupload').addClass('fileupload-new');
            $('div.fileupload-preview').html('');
        });
    });
</script>

<script>
    $(document).on('click', '.add-price', function(){
        var price = $('.price-otr').first().clone();
        var i = $('.price-otr').length;
        price.find('.price_type-inp').val('').attr('name', 'price['+i+'][price_type]');
        price.find('.price-inp').val('').attr('name', 'price['+i+'][price]');
        price.append('<div class="col-lg-1"><button class="btn btn-danger fa fa-trash-o price-remove"></button></div>');
        $('.price-otr').last().after(price);
    });

    $(document).on('click', '.price-remove', function(){
        $(this).closest('.price-otr').remove();
    })
</script>

@endpush
