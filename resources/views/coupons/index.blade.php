@extends('layouts.starlight')

@section('title', 'Coupon')

@section('coupon-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupon</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Banner</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Coupon Name</th>
                                    <th>Discount Amount (%)</th>
                                    <th>Expired Date</th>
                                    <th>Usage Limit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon -> coupon_name}}</td>
                                        <td>{{ $coupon -> discount_amount}}</td>
                                        <td>{{ $coupon -> expired_date}}</td>
                                        <td>{{ $coupon -> usage_limit}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('coupon.edit', $coupon -> id)}}" type="button" class="btn btn-sm btn-secondary">Edit</a>

                                                <form action="{{ route('coupon.destroy', $coupon -> id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>                                
                                @empty
                                    <tr>
                                        <td colspan="50"></td>
                                    </tr>                                
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Add Coupon</div>
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>Coupon Name</label>
                                <input type="text" class="form-control" name="coupon_name">
                            </div>
                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="text" class="form-control" name="discount_amount">
                            </div>
                            <div class="form-group">
                                <label>Usage Limit</label>
                                <input type="text" class="form-control" name="usage_limit">
                            </div>
                            <div class="form-group">
                                <label>Expired Date</label>
                                <input type="date" class="form-control" name="expired_date">
                            </div>
                            <button type="submit" class="btn btn-primary">Add New Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection