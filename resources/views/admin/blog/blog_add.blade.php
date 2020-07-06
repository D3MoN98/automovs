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

    .price-otr {
        display: flex;
        justify-content: flex-start !important;
        margin-bottom: 10px;
    }

    .flex-end {
        justify-content: flex-end !important;
    }

    .price-remove {
        padding: 8px;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Blog
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="cmxform form-horizontal" id="blogForm" role="form"
                        action="{{route('admin.blog.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title" class="col-lg-2 col-sm-2 control-label">Title</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="title" name="blog[title]"
                                    placeholder="Title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="excerpt" class="col-lg-2 col-sm-2 control-label">Excerpt</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="excerpt" name="blog[excerpt]"
                                    placeholder="Excerpt" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-lg-2 col-sm-2 control-label">Content</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="content" rows="8" name="blog[content]"
                                    tplaceholder="Content" required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="blog_categories" class="col-lg-2 col-sm-2 control-label">BLog Categories</label>
                            <div class="col-lg-10">
                                <select class="form-control custom-select2" id="blog_categories"
                                    name="blog[blog_category_id]" required>
                                    <option value=""></option>
                                    @foreach ($blog_categories as $blog_category)
                                    <option value="{{$blog_category->id}}">{{$blog_category->name}}</option>
                                    @endforeach
                                </select>
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
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select
                                                image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input id="file" type="file" name="blog_file[]" class="default" multiple
                                                required />
                                        </span>
                                        <a href="#" class="btn btn-danger remove-fileupload fileupload-exists"
                                            data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                <span class="label label-danger">NOTE!</span> <span>You can upload maximum 5
                                    images</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{route('admin.blog.index')}}" class="btn btn-danger">Back</a>
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
    $("#blogForm").validate({
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
		placeholder: "Select a blog category",
		maximumSelectionSize: 6,
		containerCssClass: ':all:'
    } ).on("change", function (e) {
        $(this).valid();
    });

    // $('select').select2({})

</script>
{{-- <script type="text/javascript" src="{{asset('backend/js/bootstrap-fileupload/bootstrap-fileupload.js')}}"">
</script> --}}
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
<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );
</script>
@endpush
