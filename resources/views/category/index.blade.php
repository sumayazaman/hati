@extends('layouts.starlight')

@section('title', 'Category')

@section('category-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('category') }}">Category</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white clearfix">
                    Category
                    @if( $categories -> count() != 0)
                        <button type="button" id="deleteAll" class="btn btn-danger float-right mr-3">Delete All</button>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        @if(session('category_delete_status'))
                        <div class="alert alert-danger mt-3">
                            {{ session('category_delete_status') }}
                        </div>
                        @endif()
                        <thead>
                            <tr>
                                <td>Delete?</td>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form method="POST" action="{{ route('categoryselectedelete') }}">
                        @csrf
                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete_checkbox" name = "category_id[]" value="{{ $category -> id }}" >
                                    </td>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $category -> category_name }}</td>
                                    <td><img src="{{ asset('uploads/category')}}/{{ $category -> category_photo }}" alt="not found" width="25"></td>
                                    <td>{{ $category -> created_at-> format('d-m-Y h:i:s A') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('categoryedit', ['category_id' => $category -> id]) }}" type="button" class="btn btn-secondary">Update<a>
                                            <a href="{{ route('categorydelete', ['category_id' => $category -> id]) }}" type="button" class="btn btn-danger">Delete</a> 
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50">
                                        <div class="alert alert-primary">
                                            No Category Found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <button type="button" id="check_all_btn" class="btn btn-sm btn-info">Check All</button>
                        <button type="button" id="uncheck_all_btn" class="btn btn-sm btn-warning">Uncheck All</button>
                    </div>
                    <button type="submit" class="btn btn-outline-danger float-right">Delete Selected Categories</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Add New Category
                </div>

                <div class="card-body">
                    <form action="{{ route('categorypost') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" placeholder="Enter new Category" name="category_name">
                        </div>

                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" class="form-control" name="category_photo">
                        </div>

                        @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">Add New Category</button>

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
    <div class="row m-auto">
        <div class="col-8">
            <div class="card  mt-5">
                <div class="card-header bg-warning clearfix">
                    Deleted Category List
                    @if( $categories_deleted -> count() != 0)
                        <a href ="category/allforce/delete" type="button" class="btn btn-danger float-right mr-3">Force Delete All</a>
                        <a href ="category/allrestore" type="button" class="btn btn-danger float-right mr-3">Restore All</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories_deleted as $category_deleted)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $category_deleted -> category_name }}</td>
                                    <td>{{ $category_deleted -> created_at-> format('d-m-Y h:i:s A') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <!-- <button type="button" class="btn btn-secondary">Update</button> -->
                                            <a href="{{ route('categoryrestore',['category_id' => $category_deleted -> id]) }}" type="button" class="btn btn-secondary">Restore<a>
                                            <a href="{{ route('categoryforcedelete',['category_id' => $category_deleted -> id]) }}" type="button" class="btn btn-danger">Force Delete</a> 
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50">
                                        <div class="alert alert-primary">
                                            No Deleted Category Found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('sweetalert')
<script>
    $(document).ready(function(){
        $( "#deleteAll" ).click(function() {
            Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/category/all/delete";
            }
            })
        });
        $('#check_all_btn').click(function(){
            $('.delete_checkbox').attr('checked','checked');
        })
        $('#uncheck_all_btn').click(function(){
            $('.delete_checkbox').removeAttr('checked');
        })
    })
</script>
@endsection