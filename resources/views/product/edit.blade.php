@extends('layouts.starlight')

@section('title', 'Product Edit')

@section('category-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('product') }}">Product</a>
    <span class="breadcrumb-item active">Edit - {{ $product_info -> product_name }}</span>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Update Product Information
                </div>
                <div class="card-body">
                    <form action="{{ route('producteditpost',$product_info -> id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category -> id }}" 
                                        @if ($product_info -> category_id == $category -> id)
                                            selected
                                        @endif>
                                        {{ $category -> category_name }}
                                    </option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="hidden" class="form-control" name="id" value="{{ $product_info -> id}}">
                            <input type="text" class="form-control" name="product_name" value="{{ $product_info -> product_name}}">
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price" value="{{ $product_info -> product_price}}">
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" name="product_quantity" value="{{ $product_info -> product_quantity}}">
                        </div>
                        <div class="form-group">
                            <label>Product Short Description</label>
                            <textarea class="form-control" name="product_short_description" rows="4">{{ $product_info -> product_short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Long Description</label>
                            <textarea class="form-control" name="product_long_description" rows="4">{{ $product_info -> product_long_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Alert Quantity</label>
                            <input type="text" class="form-control" name="product_alert_quantity" value="{{ $product_info -> product_alert_quantity}}">
                        </div>
                        <div class="form-group">
                            <label>Product Image Old</label>
                            <img src="{{ asset('uploads/product/'.$product_info -> product_photo)}}" alt="" class="w-50 form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Image New</label>
                            <input type="file" class="form-control" name="product_photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        @if(session('category_insert_status'))
                        <div class="alert alert-success mt-3">
                            {{ session('category_insert_status') }}
                        </div>
                        @endif()
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection