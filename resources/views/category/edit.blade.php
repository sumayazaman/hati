@extends('layouts.starlight')

@section('title', 'Category Edit')

@section('category-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('category') }}">Category</a>
    <span class="breadcrumb-item active">Edit - {{ $category_info -> category_name }}</span>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 m-auto">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Update Category Information
                </div>
                <div class="card-body">
                    <form action="{{ url('/category/post/edit') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <input type="hidden" name="category_id" value="{{ $category_info -> id }}">
                            <input type="text" class="form-control" placeholder="Enter new Category" name="category_name" value="{{ $category_info -> category_name }}">
                            @if($errors ->all())
                                @foreach($errors->all() as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
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