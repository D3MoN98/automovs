@extends('admin.layout.dashboard')

@push('styles')
<link href="{{ asset('backend/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/js/data-tables/DT_bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-switch.css') }}" />
<style>
    .has-switch {
        min-width: 55px;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Category List
                {{-- <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span> --}}
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="btn-group pull-right">
                        <a href="{{route('admin.blog_category.create')}}" class="btn btn-primary">Add A Category <i
                                class="fa fa-plus"></i>
                        </a>
                    </div>
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog_categories as $blog_category)
                            <tr>
                                <td>{{$blog_category->id}}</td>
                                <td>{{$blog_category->name}}</td>
                                <td>{{$blog_category->slug}}</td>
                                <td>{{$blog_category->created_at}}</td>
                                <td>{{$blog_category->updated_at}}</td>
                                <td class="center">
                                    <a href="{{route('admin.blog_category.edit', $blog_category->id)}}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form class="edit-form"
                                        action="{{route('admin.blog_category.destroy', $blog_category->id)}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm edit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" language="javascript"
    src="{{ asset('backend/js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/data-tables/DT_bootstrap.js') }}"></script>
<script src="{{ asset('backend/js/dynamic_table_init.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-switch.js') }}"></script>
<script src="{{ asset('backend/js/toggle-init.js') }}"></script>


<script>
    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        var _this = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                _this.closest('form').submit();
            }
        })
    })
</script>

@endpush
