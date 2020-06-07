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
                Service Booking List
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
                                <th>Service</th>
                                <th>Payment Id</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service_books as $service_book)
                            <tr>
                                <td>{{$service_book->id}}</td>

                                <td><a href="{{route('admin.user.edit', $service_book->user->id)}}" class="btn-link">{{$service_book->user->name}}</a></td>

                                <td><a href="{{route('admin.service.edit', $service_book->service->id)}}" class="btn-link">{{$service_book->service->name }}</a></td>

                                <td><a href="{{route('admin.payment.show', $service_book->payment->id)}}" class="btn-link">{{$service_book->payment->payment_id}}</a></td>

                                <td>{{$service_book->created_at}}</td>

                                <td>{{$service_book->updated_at}}</td>
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
