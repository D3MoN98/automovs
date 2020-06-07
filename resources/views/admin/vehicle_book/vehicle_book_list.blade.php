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
                Vehicle Booking List
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
                                <th>Vehicle</th>
                                <th>Payment Id</th>
                                <th class="text-center">Verified</th>
                                <th>Verified At</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicle_books as $vehicle_book)
                            <tr>
                                <td>{{$vehicle_book->id}}</td>

                                <td><a href="{{route('admin.user.edit', $vehicle_book->user->id)}}" class="btn-link">{{$vehicle_book->user->name}}</a></td>

                                <td><a href="{{route('admin.user.edit', $vehicle_book->vehicle->id)}}" class="btn-link">{{$vehicle_book->vehicle->brand . ' - ' . $vehicle_book->vehicle->model }}</a></td>

                                <td><a href="{{route('admin.payment.show', $vehicle_book->payment->id)}}" class="btn-link">{{$vehicle_book->payment->payment_id}}</a></td>

                                <td class="text-center"><input type="checkbox" {{ $vehicle_book->is_verified == 1 ? 'checked' : ''}} class="switch-mini verify_toggle" data-id={{$vehicle_book->id}}></td>

                                <td>{{$vehicle_book->verified_at}}</td>

                                <td>{{$vehicle_book->created_at}}</td>

                                <td>{{$vehicle_book->updated_at}}</td>
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
    $(document).on('change', '.verify_toggle', function(){
        var vehicle_id = $(this).data('id');
        var is_checked = $(this).is(":checked");
        var is_verified = is_checked ? 1 : 0;
        $.ajax({
            url: '{{url("admin/vehicle/update/is_verified")}}',
            data: {'_token': '{{ csrf_token() }}', 'is_verified': is_verified, 'id': vehicle_id},
            type: 'post',
            dataType: 'json',
            success:function(data){
                console.log(data);
            }
        });
    });
</script>
@endpush
