@extends('layouts.tohoney')

@section('body')
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All product</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a data-toggle="tab" href="#id_{{ $category -> id }}">{{ $category -> category_name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @foreach ($products as $product)
                        @include('includes/product')
                    @endforeach
                </ul>
            </div>
            @foreach ($categories as $category)
                <div class="tab-pane" id="id_{{ $category -> id }}">
                    @php
                        $products_all = App\Models\Product::where('category_id', $category -> id)->get();
                    @endphp
                    <ul class="row">
                        @foreach ($products_all as $product)
                            @include('includes/product')
                        @endforeach
                    </ul>
                </div>                
            @endforeach
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection