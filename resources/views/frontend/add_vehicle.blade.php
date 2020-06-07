@extends('frontend.layout.front')

@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('backend/js/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
<style>
    .fileupload img.img-thumbnail {
        max-width: 200px !important;
        margin-right: 5px !important;
        background-color: transparent;
        border: 1px solid #5c2626;
    }
    .custom-select2{
        background: transparent !important;
        border: 1px solid #5c2626!important;
    }
    .select2-selection__placeholder{
        color: #5c2626!important;
        letter-spacing: 1px;
    }

</style>
@endpush

@section('content')
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron bg-default">
                    <h1 class="display-3 wow fadeInLeft" data-wow-delay="0.2s">Add Post</h1>
                    <p class="lead wow fadeInLeft" data-wow-delay="0.5s">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias officia magnam,
                        perspiciatis temporibus porro, repellat iste saepe ullam consequuntur, inventore fuga soluta
                        eius beatae assumenda nesciunt veritatis autem cumque iure.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('vehicle.store')}}" method="POST" enctype="multipart/form-data" class="cmxform reg-form wow fadeInLeft"  id="vehicleForm" data-wow-delay="0.8s">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" id="brand" minlength="2" name="vehicle[brand]" placeholder="Brand" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="model" name="vehicle[model]" placeholder="Model" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="variant" name="vehicle[variant]" placeholder="Variant" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="registration_number" name="vehicle[registration_number]" placeholder="Registration Number" required>
                    </div>

                    <div class="form-group">
                        <select  class="form-control custom-select2" id="type" name="vehicle[type]" placeholder="Type" required>
                            <option value="4-wheeler">4 Wheeler</option>
                            <option value="2-wheeler">2 Wheeler</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="driven" name="vehicle[driven]" placeholder="Driven" required>
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" id="color" name="vehicle[color]" placeholder="Color" required>
                    </div>

                    <div class="form-group">
                        <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="4" class="form-control" id="year_bought" name="vehicle[year_bought]" placeholder="Year  Bought" required>
                    </div>

                    <div class="form-group">
                        <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="4" class="form-control" id="insurance" name="vehicle[insurance]" placeholder="Insurance" required>
                    </div>


                    <div class="form-group">
                        <select  class="form-control custom-select2" id="location" name="vehicle[location]" required>
                            <option value=""></option>
                            @foreach ($locations as $location)
                            <option value="{{$location->id}}">{{$location->city_name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="price" name="vehicle[price]" placeholder="Price" required>
                    </div>

                    <div class="form-group last">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" class="img-thumbnail" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-sm btn-white btn-file">
                                <span class="fileupload-new"><i class="fas fa-paperclip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fas fa-undo"></i> Change</span>
                                <input id="file" type="file" name="vehicle_file[]" class="default" multiple required/>
                                </span>
                                <a href="#" class="btn btn-sm btn-danger remove-fileupload fileupload-exists" data-dismiss="fileupload"><i class="fas fa-trash"></i> Remove</a>
                            </div>
                        </div>
                        <span class="badge badge-danger">NOTE!</span> <span>You can upload maximum 5 images</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Post</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
<script>
    $("#vehicleForm").validate({
    errorClass: 'form-text text-danger',
    errorElement: 'small',
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
		placeholder: "Select a location",
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

@endpush
