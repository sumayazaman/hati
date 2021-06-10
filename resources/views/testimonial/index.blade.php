@extends('layouts.starlight')

@section('title', 'Testimonial')

@section('testimonial-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('testimonial.index') }}">Testimonial</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Testimonial</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Profession</th>
                                    <th>Testimonial</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($testimonials as $testimonial)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('uploads/testimonial/'.$testimonial -> image) }}" alt="not found" width="50">
                                        </td>
                                        <td>{{ $testimonial -> name }}</td>
                                        <td>{{ $testimonial -> profession }}</td>
                                        <td>{{ $testimonial -> description }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('testimonial.edit', $testimonial -> id)}}" type="button" class="btn btn-sm btn-secondary">Edit</a>
                                                <form action="{{ route('testimonial.destroy', $testimonial -> id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
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
                <div class="card-header bg-primary text-white">Add Testimonial</div>
                <div class="card-body">
                    <form action="{{ route('testimonial.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Client's Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>Client's Profession</label>
                                <input type="text" class="form-control" name="profession" value="{{ old('profession') }}">
                            </div>
                            <div class="form-group">
                                <label>Client's Testimonial</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Client's Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Add New Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection