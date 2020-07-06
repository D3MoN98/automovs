@extends('admin.layout.dashboard')

@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('backend/js/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
<style>
    .fileupload-preview img.img-thumbnail {
        max-width: 135px !important;
        margin-right: 5px !important;
        margin-bottom: 10px !important;
    }

    .fileupload-new img.img-thumbnail {
        max-width: 135px !important;
        margin-right: 5px !important;
        margin-bottom: 10px !important;
    }

    .fileupload .thumbnail {
        display: flex;
        justify-content: space-evenly;
        flex-flow: wrap;
    }

    .img-thumbnail-otr {
        position: relative;
    }

    .img-thumbnail-otr .fa-times-circle {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 10px;
        color: white;
        font-size: 18px;
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
                Edit Blog Category
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="cmxform form-horizontal" id="blogCategoryForm" role="form"
                        action="{{route('admin.blog_category.update', $blog_category->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="name" value="{{$blog_category->name}}"
                                    minlength="2" name="blog_category[name]" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="slug" class="col-lg-2 col-sm-2 control-label">Slug</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" value="{{$blog_category->slug}}"
                                    minlength="2" name="blog_category[slug]" placeholder="Slug" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('admin.blog_category.index')}}" class="btn btn-danger">Back</a>
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
    $("#blogCategoryForm").validate({
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
@endpush
