@extends('layouts.starlight')

@section('title', 'Product')

@section('product-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('product') }}">Product</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header bg-primary text-white clearfix">
                    Products
                {{-- @if( $products -> count() != 0)
                        <button type="button" id="deleteAll" class="btn btn-danger float-right mr-3">Delete All</button>
                @endif  --}}
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        {{-- @if(session('category_delete_status'))
                            <div class="alert alert-danger mt-3">
                                {{ session('category_delete_status') }}
                            </div>
                        @endif() --}}
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Alert Quantity</th>
                                <th>Product Photo</th>
                                <th>Added by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        {{-- <form method="POST" action="{{ route('') }}"> --}}
                        @csrf
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ App\Models\Category::findOrFail($product -> category_id)  -> category_name}}</td>
                                    <td>{{ $product -> product_name }}</td>
                                    <td>{{ $product -> product_price }}</td>
                                    <td>{{ $product -> product_quantity }}</td>
                                    <td>{{ $product -> product_alert_quantity }}</td>
                                    <td >
                                        <img src="{{ asset('uploads/product') }}/{{ $product -> product_photo }}" alt="" width="50">
                                    </td>
                                    <td>{{ App\Models\User::find($product -> user_id) -> name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example"> 
                                            <a href="{{ route('productedit', ['product_id' => $product -> id]) }}" type="button" class="btn btn-secondary">Edit<a>
                                            <a href="{{ route('productdelete', ['product_id' => $product -> id]) }}" type="button" class="btn btn-danger">Delete</a> 
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50">
                                        <div class="alert alert-primary">
                                            No Product Found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="btn-group">
                        <button type="button" id="check_all_btn" class="btn btn-sm btn-info">Check All</button>
                        <button type="button" id="uncheck_all_btn" class="btn btn-sm btn-warning">Uncheck All</button>
                    </div>
                    <button type="submit" class="btn btn-outline-danger float-right">Delete Selected Categories</button>
                </form> --}}
            </div>
        </div>
    </div>
    <div class="col-4 m-auto">
        <div class="card">
            <div class="card-header text-white bg-primary">
                Add New Product
            </div>
            <div class="card-body">
                <form action="{{ route('productpost') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">

                        @if(session('product_insert_status'))
                            <div class="alert alert-success mt-3">
                                {{ session('product_insert_status') }}
                            </div>
                        @endif()

                        <label>Category Name</label>
                        <select name="category_id" id="" class="form-control">
                            <option value=""> - -Choose One - -</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category -> id }}">{{ $category -> category_name }}</option>                                    
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name">
                    </div>
                    @error('')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="product_price">
                    </div>

                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity">
                    </div>

                    <div class="form-group">
                        <label>Product Short Description</label>
                        <textarea type="text" class="form-control" name="product_short_description" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Product Long Description</label>
                        <textarea type="text" class="form-control" name="product_long_description" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Product Alert Quantity</label>
                        <input type="text" class="form-control" name="product_alert_quantity">
                    </div>

                    <div class="form-group">
                        <label>Product Photo</label>
                        <input type="file" class="form-control" name="product_photo">
                    </div>

                    <div class="form-group">
                        <label>Product Photo</label>
                        <input type="file" class="form-control" name="feature_photo[]" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product Category</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection