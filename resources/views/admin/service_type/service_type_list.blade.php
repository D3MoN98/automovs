@extends('admin.layout.dashboard')

@push('styles')
<link href="{{ asset('backend/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/js/data-tables/DT_bootstrap.css') }}">
@endpush

@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Service Type List
                {{-- <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span> --}}
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service_types as $service_type)
                            <tr>
                                <td>{{$service_type->id}}</td>
                                <td>{{$service_type->name}}</td>
                                <td>{{$service_type->description}}</td>
                                <td>{{$service_type->created_at}}</td>
                                <td>{{$service_type->updated_at}}</td>
                                <td class="center">
                                    <a href="{{route('admin.service_type.edit', $service_type->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <form class="edit-form" action="{{route('admin.service_type.destroy', $service_type->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm delete">Delete</button>
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


<script>
    $(document).on('click', '.delete', function(e){
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
