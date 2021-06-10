@extends('layouts.starlight')

@section('title', 'Banner')

@section('banner-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('banner') }}">Banner</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Edit Banner</div>
                <div class="card-body">
                    <form action="{{ route('banneredit', $banner_info -> id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Banner title</label>
                                <input type="text" class="form-control" name="title" value="{{ $banner_info -> title}}">
                            </div>

                            <div class="form-group">
                                <label>Banner Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ $banner_info -> description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Banner Current Image</label>
                                <img src="{{ asset('uploads/banner/'. $banner_info ->image )}}" alt="not found" width="200">
                            </div>

                            <div class="form-group">
                                <label>Banner New Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                        <button type="submit" class="btn btn-primary">Update Banner Information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection