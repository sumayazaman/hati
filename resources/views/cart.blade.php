@extends('layouts.tohoney')

@section('title', 'Cart')

@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('cart.update')}}" method="POST">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                                $flag = false;
                            @endphp
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="images">
                                        <img src="{{ asset('uploads/product') }}/{{ $cart -> product -> product_photo }}" alt="not found">
                                    </td>

                                    <td class="product">
                                        <a href="{{ route('productdetails', $cart -> product_id)}}">
                                            {{ $cart -> product -> product_name }}

                                            @if ($cart -> product -> product_quantity < $cart -> quantity)
                                                <span class="badge badge-danger">Stock Not Available</span>
                                                @php
                                                    $flag = true;
                                                @endphp
                                            @endif
                                        </a>
                                    </td>

                                    <td class="ptice">${{ $cart -> product -> product_price }}</td>
                                    
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" name = "quantity[{{ $cart ->id }}]" value="{{ $cart -> quantity }}" />
                                    </td>

                                    <td class="total">{{ $cart -> quantity * $cart -> product -> product_price }}</td>

                                    @php
                                        $subtotal += $cart -> quantity * $cart -> product -> product_price;
                                    @endphp

                                    <td class="remove">
                                        <a href="{{ route('cartdelete', $cart -> id )}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>                                
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button type="submit">Update Cart</button>
                                    </li>
                                    <li><a href="{{ route('shop') }}">Continue Shopping</a></li>
                                </ul>
                                <h3>Cupon</h3>
                                <p>Enter Your Cupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" placeholder="Cupon Code" id="coupon_value" value="{{$coupon_name }}">
                                    <button type="button" id="coupon">Apply Cupon</button>
                                    @error('coupon_error')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>{{ $subtotal }}</li>
                                    <li><span class="pull-left">Discount Amount </span>{{ $discount = $subtotal* $discount_amount*.01 }}</li>
                                    <li><span class="pull-left"> Total </span>{{$total = $subtotal - $subtotal* $discount_amount*.01 }} </li>
                                </ul>
                                @php
                                    session([
                                        'coupon_name' => $coupon_name,
                                        'discount_amount' => $discount,
                                        'subtotal' => $subtotal,
                                        'total' => $total
                                    ])
                                @endphp
                                @if ($flag)
                                    <a href="">Update your Cart</a>                                    
                                @else
                                    <a href="{{ route('checkout')}}">Proceed to Checkout</a>                                    
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection

@section('footer_script')
<script>
    $(document).ready(function(){
        $("#coupon").click(function(){
            var coupon_value = $("#coupon_value").val();
            var link = "{{ route('cart') }}/" + coupon_value;
            window.location.href = link;
        });
    })
</script>
@endsection