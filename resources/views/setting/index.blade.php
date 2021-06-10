@extends('layouts.starlight')

@section('title', 'Setting')

@section('setting-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('setting') }}">Setting</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header text-white bg-primary">
                Update Setting Information
            </div>
            <div class="card-body">
                
                <form action="{{ route('setting') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="{{ $settings -> where('setting_name', 'phone') -> first() -> setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ $settings -> where('setting_name', 'email') -> first() -> setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Facebook Link</label>
                        <input type="text" class="form-control" name="fb-link" value="{{ $settings -> where('setting_name', 'fb-link') -> first() -> setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Twitter Link</label>
                        <input type="text" class="form-control" name="tw-link" value="{{ $settings -> where('setting_name', 'tw-link') -> first() -> setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Linkdin Link</label>
                        <input type="text" class="form-control" name="link-link" value="{{ $settings -> where('setting_name', 'link-link') -> first() -> setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="10">{{ $settings -> where('setting_name', 'address') -> first() -> setting_value }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="10">{{ $settings -> where('setting_name', 'description') -> first() -> setting_value }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Settings</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection