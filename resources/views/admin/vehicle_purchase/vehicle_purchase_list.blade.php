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
                Vehicle Purchases List
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
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicle_purchases as $vehicle_purchase)
                            <tr>
                                <td>{{$vehicle_purchase->id}}</td>

                                <td><a href="{{route('admin.user.edit', $vehicle_purchase->user->id)}}" class="btn-link">{{$vehicle_purchase->user->name}}</a></td>

                                <td><a href="{{route('admin.vehicle.edit', $vehicle_purchase->vehicle->id)}}" class="btn-link">{{$vehicle_purchase->vehicle->brand . ' - ' . $vehicle_purchase->vehicle->model }}</a></td>

                                <td><a href="{{route('admin.payment.show', $vehicle_purchase->payment->id)}}" class="btn-link">{{$vehicle_purchase->payment->payment_id}}</a></td>

                                <td>{{$vehicle_purchase->created_at}}</td>

                                <td>{{$vehicle_purchase->updated_at}}</td>
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
@endpush
