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
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Vehicle
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="cmxform form-horizontal"  id="vehicleForm" role="form" action="{{route('admin.vehicle.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="brand" class="col-lg-2 col-sm-2 control-label">Brand</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="brand" minlength="2" name="vehicle[brand]" placeholder="Brand" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="model" class="col-lg-2 col-sm-2 control-label">Model</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="model" name="vehicle[model]" placeholder="Model" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="variant" class="col-lg-2 col-sm-2 control-label">Variant</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="variant" name="vehicle[variant]" placeholder="Variant" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="registration_number" class="col-lg-2 col-sm-2 control-label">Registration Number</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="registration_number" name="vehicle[registration_number]" placeholder="Registration Number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-lg-2 col-sm-2 control-label">Type</label>
                            <div class="col-lg-10">
                                <select  class="form-control custom-select2" id="type" name="vehicle[type]" placeholder="Type" required>
                                    <option value="4-wheeler">4 Wheeler</option>
                                    <option value="2-wheeler">2 Wheeler</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="driven" class="col-lg-2 col-sm-2 control-label">Driven</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="driven" name="vehicle[driven]" placeholder="Driven" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="color" class="col-lg-2 col-sm-2 control-label">Color</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="color" name="vehicle[color]" placeholder="Color" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="year_bought" class="col-lg-2 col-sm-2 control-label">Year Bought</label>
                            <div class="col-lg-10">
                                <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="4" class="form-control" id="year_bought" name="vehicle[year_bought]" placeholder="Year  Bought" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="insurance" class="col-lg-2 col-sm-2 control-label">Insurance</label>
                            <div class="col-lg-10">
                                <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="4" class="form-control" id="insurance" name="vehicle[insurance]" placeholder="Insurance" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="location" class="col-lg-2 col-sm-2 control-label">Location</label>
                            <div class="col-lg-10">
                                <select  class="form-control custom-select2" id="location" name="vehicle[location]" required>
                                    <option value=""></option>
                                    @foreach ($locations as $location)
                                    <option value="{{$location->id}}">{{$location->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price" class="col-lg-2 col-sm-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="price" name="vehicle[price]" placeholder="Price" required>
                            </div>
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
                                        <input id="file" type="file" name="vehicle_file[]" class="default" multiple required/>
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
    $("#vehicleForm").validate({

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
