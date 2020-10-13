<form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">Coupon Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="modelEditBody">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="coupon[name]" id="" class="form-control" value="{{$coupon->name}}"
                placeholder="Name" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Code</label>
            <input type="text" name="coupon[code]" id="" class="form-control" value="{{$coupon->code}}"
                placeholder="Unique Code" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Description</label>
            <textarea name="coupon[description]" id="" cols="30" rows="10" class="form-control"
                placeholder="Description">{{$coupon->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Discount Amount</label>
            <input type="number" name="coupon[discount_amount]" id="" value="{{$coupon->discount_amount}}"
                class="form-control" placeholder="Discount Amount" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Fixed Or Percentage</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="coupon[is_fixed]" id="" value="1"
                        {{$coupon->is_fixed == 1 ? 'checked' : ''}}>
                    Fixed
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="coupon[is_fixed]" id="" value="0"
                        {{$coupon->is_fixed == 0 ? 'checked' : ''}}>
                    Percentage
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="">Start Date</label>
            <input type="date" name="coupon[start_at]" id="" value="{{date('Y-m-d' , strtotime($coupon->start_at))}}"
                class="form-control" placeholder="Start Date" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Expire Date</label>
            <input type="date" name="coupon[expires_at]" id=""
                value="{{date('Y-m-d' , strtotime($coupon->expires_at))}}" class="form-control"
                placeholder="Expire Date" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="">Type</label>
            <select class="form-control" name="coupon[type]" id="" required>
                <option value="">Select Type</option>
                <option value="all" {{$coupon->type == 'all' ? 'selected' : ''}}>All</option>
                <option value="vehicle" {{$coupon->type == 'vehicle' ? 'selected' : ''}}>Vehicle</option>
                <option value="service" {{$coupon->type == 'service' ? 'selected' : ''}}>Service</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
