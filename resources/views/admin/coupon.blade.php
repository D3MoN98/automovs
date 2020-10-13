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

    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Coupons
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="btn-group pull-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                            Generate A Coupon
                        </button>
                    </div>

                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Discount</th>
                                <th class="text-center">Active</th>
                                <th>Started At</th>
                                <th>Expired At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->name}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->type}}</td>
                                <td>{{$coupon->discount_amount}} {{$coupon->is_fixed == 0 ? '%' : 'fixed'}}</td>
                                <td>{{$coupon->is_active}}</td>
                                <td>{{$coupon->start_at}}</td>
                                <td>{{$coupon->expires_at}}</td>
                                <td>
                                    <a href="{{route('admin.coupon.edit', $coupon->id)}}"
                                        class="btn btn-info btn-sm coupon_edit" data-toggle="modal"
                                        data-target="#modelEdit">Edit</a>
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



<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.coupon.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Coupon Generator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="coupon[name]" id="" class="form-control" placeholder="Name"
                            aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" name="coupon[code]" id="" class="form-control" placeholder="Unique Code"
                            aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="coupon[description]" id="" cols="30" rows="10" class="form-control"
                            placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Discount Amount</label>
                        <input type="number" name="coupon[discount_amount]" id="" class="form-control"
                            placeholder="Discount Amount" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Fixed Or Percentage</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="coupon[is_fixed]" id="" value="1"
                                    checked>
                                Fixed
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="coupon[is_fixed]" id="" value="0"
                                    checked>
                                Percentage
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date" name="coupon[start_at]" id="" class="form-control" placeholder="Start Date"
                            aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Expire Date</label>
                        <input type="date" name="coupon[expires_at]" id="" class="form-control"
                            placeholder="Expire Date" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Type</label>
                        <select class="form-control" name="coupon[type]" id="" required>
                            <option value="">Select Type</option>
                            <option value="all">All</option>
                            <option value="vehicle">Vehicle</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" language="javascript"
    src="{{ asset('backend/js/advanced-datatable/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/data-tables/DT_bootstrap.js') }}"></script>
<script src="{{ asset('backend/js/dynamic_table_init.js') }}"></script>

<script>
    $(document).on('click', '.coupon_edit', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            // dataType: 'json',
            success:function(data){

            }
        })
    })
</script>
@endpush
