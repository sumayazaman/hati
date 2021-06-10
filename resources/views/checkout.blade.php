@extends('layouts.tohoney')

@section('title', 'Checkout')

@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
@auth
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details (Logged in As: {{ auth()->user()->name }}) </h3>
                    <form id = "main_form" action="{{ route('checkout')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phone">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select id="countries" name="country_id">
                                    <option value="">--Select One--</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country -> id }}">{{ $country -> name}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select id="cities" name="city_id">
                                    <option value="">--Select One--</option>                                    
                                </select>
                            </div>                                
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="postcode">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <input type="text">
                            </div>                     
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="message" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        <li>Coupon Name <span class="pull-right">{{ session('coupon_name')}}</span></li>
                        <li>Discount Amount <span class="pull-right"><strong>${{ session('discount_amount') }}</strong></span></li>
                        <li>Subtotal <span class="pull-right"><strong>${{ session('subtotal') }}</strong></span></li>
                        <li>Shipping <span class="pull-right">Free</span></li>
                        <li>Total<span class="pull-right">${{ session('total') }}</span></li>
                    </ul>
                    <ul class="payment-method">                            
                        <li>
                            <input id="card" type="radio" name="payment_option" value="1" checked>
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment_option" value="2">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button id = "place_order_btn" type="button">Place Order</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="alert alert-danger">
                    If you are not logged in. If you already have an account.
                    <a href="{{ route('customer.login')}}">Log in here</a>
                    To open an account
                    <a href="{{ route('customer.register') }}">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
<!-- checkout-area start -->

@endsection

@section('footer_script')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#countries').select2();
            $('#countries').change(function () {
                var country_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/city/checkout',
                    data:{country_id:country_id},
                    success: function (data) {
                        $('#cities').html(data);
                    }
                });
            });

            $('#place_order_btn').click(function(){
                if ($("input[name='payment_option']:checked").val() == 1) {
                    $('#main_form').attr('action','http://127.0.0.1:8000/pay');
                } else {
                    $('#main_form').attr('action','http://127.0.0.1:8000/checkout');                    
                }
                $("#main_form").submit();
            })
        });
    </script>
@endsection