@extends('layouts.starlight')

@section('title', 'Testimonial')

@section('testimonial-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('testimonial.index') }}">Testimonial</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">Edit Testimonial</div>
                <div class="card-body">
                    <form action="{{ route('testimonial.update', $testimonial -> id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class="form-group">
                                <label>Client's Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $testimonial -> name }}">
                            </div>
                            <div class="form-group">
                                <label>Client's Profession</label>
                                <input type="text" class="form-control" name="profession" value="{{ $testimonial -> profession }}">
                            </div>
                            <div class="form-group">
                                <label>Client's Testimonial</label>
                                <textarea name="description" class="form-control" rows="5">{{ $testimonial -> description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Client's Current Image</label>
                                <img src="{{ asset('uploads/testimonial/'. $testimonial -> image)}}" alt="" width="100">
                            </div>
                            <div class="form-group">
                                <label>Client's Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection