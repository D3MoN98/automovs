@extends('admin.layout.dashboard')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Payment Details
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="payment_id" class="col-lg-2 col-sm-2 control-label">Payment Id</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="payment_id" value="{{$payment->payment_id}}" placeholder="payment_id" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_request_id" class="col-lg-2 col-sm-2 control-label">Payment Request Id</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="payment_request_id" value="{{$payment->payment_request_id}}" placeholder="payment_request_id" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="order_type" class="col-lg-2 col-sm-2 control-label">Order Type</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="order_type" value="{{$payment->order_type}}" placeholder="order_type" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="purpose" class="col-lg-2 col-sm-2 control-label">Purpose</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="purpose" value="{{$payment->purpose}}" placeholder="purpose" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-lg-2 col-sm-2 control-label">Amount</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="amount" value="{{$payment->amount}}" placeholder="amount" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="col-lg-2 col-sm-2 control-label">Quantity</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="quantity" value="{{$payment->quantity}}" placeholder="quantity" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-lg-2 col-sm-2 control-label">Status</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="status" value="{{$payment->status}}" placeholder="status" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
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
