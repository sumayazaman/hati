@extends('layouts.tohoney')

@section('title', 'Checkout')

@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">

                <form action="{{ route('customer.login') }}" method="POST">
                    @csrf

                    <div class="account-form form-style">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        <p>Email Address *</p>
                        <input type="email" name="email">
                        <p>Password *</p>
                        <input type="password" name="password">
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="password" type="checkbox">
                                <label for="password">Save Password</label>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#">Forget Your Password?</a>
                            </div>
                        </div>
                        <button type="submit">LOGIN</button>
                        <div class="text-center">
                            <a href="{{ route('customer.register') }}">Or Create an Account</a>
                        </div>
                    </div>

                </form>                

            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
<!-- start social-newsletter-section -->
<section class="social-newsletter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="newsletter text-center">
                    <h3>Subscribe  Newsletter</h3>
                    <div class="newsletter-form">
                        <form>
                            <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</section>
@endsection