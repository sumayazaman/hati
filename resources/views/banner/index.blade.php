@extends('layouts.starlight')

@section('title', 'Banner')

@section('banner-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('banner') }}">Banner</a>
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
                                    <th>Banner Image</th>
                                    <th>Banner Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banners as $banner)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('uploads/banner/'.$banner->image)}}" alt="" width="50">
                                        </td>
                                        <td>{{ $banner -> title}}</td>
                                        <td>{{ $banner -> description}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('banneredit', $banner -> id) }}" type="button" class="btn btn-sm btn-secondary">Edit</a>
                                                <a href="{{ route('bannerdelete', $banner -> id) }}" type="button" class="btn btn-sm btn-danger">Delete</a>
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
                <div class="card-header bg-primary text-white">Add Banner</div>
                <div class="card-body">
                    <form action="{{ route('banner') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Banner title</label>
                                <input type="text" class="form-control" name="title">
                            </div>

                            <div class="form-group">
                                <label>Banner Description</label>
                                <textarea name="description" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Banner Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                        <button type="submit" class="btn btn-primary">Add New Banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection