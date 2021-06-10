@extends('layouts.starlight')

@section('title', 'Coupon')

@section('coupon-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupon</a>
@endsection()

@section('content')
<div class="col-6 m-auto">
    <div class="card">
        <div class="card-header bg-primary text-white">Edit Coupon</div>
        <div class="card-body">
            <form action="{{ route('coupon.update', $coupon ->id ) }}" method="POST">
                @csrf
                @method('PATCH')
                    <div class="form-group">
                        <label>Coupon Name</label>
                        <input type="text" class="form-control" name="coupon_name" value="{{ $coupon -> coupon_name}}">
                    </div>
                    <div class="form-group">
                        <label>Discount Amount</label>
                        <input type="text" class="form-control" name="discount_amount" value="{{ $coupon -> discount_amount}}">
                    </div>
                    <div class="form-group">
                        <label>Usage Limit</label>
                        <input type="text" class="form-control" name="usage_limit" value="{{ $coupon -> usage_limit}}">
                    </div>
                    <div class="form-group">
                        <label>Expired Date</label>
                        <input type="date" class="form-control" name="expired_date" value="{{ $coupon -> expired_date}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Coupon</button>
            </form>
        </div>
    </div>
</div>
@endsection