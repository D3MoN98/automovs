@extends('admin.layout.dashboard')

@push('styles')
<link href="{{ asset('backend/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/js/data-tables/DT_bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-switch.css') }}" />
<style>
    .has-switch{
        min-width: 55px;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Service List
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
                                <th>User</th>
                                <th>Name</th>
                                <th>Service Type</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->user->name}}</td>
                                <td>{{$service->name}}</td>
                                <td>{{$service->service_type->name}}</td>
                                <td>
                                    @php
                                        $prices = json_decode($service->price);
                                    @endphp
                                    @foreach ($prices as $price)
                                    <b>{{$price->price_type}}:</b> {{$price->price}} <br>
                                    @endforeach
                                </td>
                                <td>{{$service->created_at}}</td>
                                <td>{{$service->updated_at}}</td>
                                <td class="center">
                                    <a href="{{route('admin.service.edit', $service->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <form class="edit-form" action="{{route('admin.service.destroy', $service->id)}}" method="POST">
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
