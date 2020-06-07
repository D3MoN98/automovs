@extends('admin.layout.dashboard')

@push('styles')

@endpush

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Service Type
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="cmxform form-horizontal"  id="service_typeForm" role="form" action="{{route('admin.service_type.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-lg-2 col-sm-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="name" minlength="2" name="service_type[name]" placeholder="name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-lg-2 col-sm-2 control-label">Description</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="description" name="service_type[description]" placeholder="description" required>
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
    $("#service_typeForm").validate();
</script>
@endpush
