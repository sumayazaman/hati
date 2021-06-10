@extends('layouts.starlight')

@section('title', 'Category Edit')

@section('category-active', 'active')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('faq') }}">FAQ</a>
    <span class="breadcrumb-item active">Edit - {{ $faq_info -> id }}</span>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Update FAQ Information
                </div>
                <div class="card-body">
                    <form action="{{ route('faqupdate')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label>FAQ</label>
                            <input type="hidden" name="faq_id" value="{{ $faq_info -> id }}">
                            <input type="text" class="form-control" name="question" value="{{ $faq_info -> question }}">
                            @if($errors ->all())
                                @foreach($errors->all() as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea class="form-control" rows="8" name="answer">{{ $faq_info -> answer }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection