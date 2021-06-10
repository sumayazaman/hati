@extends('layouts.starlight')

@section('title', 'FAQ')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('faq') }}">FAQ</a>
@endsection()

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white clearfix">
                    Frequently Asked Questions
                    {{-- @if( $categories -> count() != 0)
                        <button type="button" id="deleteAll" class="btn btn-danger float-right mr-3">Delete All</button>
                    @endif --}}
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
                                <th>Serial No</th>
                                <th>Questions</th>
                                <th>Answers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @csrf
                            @forelse($faqs as $faq)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $faq -> question }}</td>
                                    <td>{{ $faq -> answer }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('faqedit', $faq -> id) }}" type="button" class="btn btn-secondary">Edit<a>
                                            <a href="{{ route('faqdelete', $faq -> id) }}" type="button" class="btn btn-danger">Delete</a> 
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
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Add Frequently Asked Questions
                </div>
                <div class="card-body">
                    <form action="{{ route('faq')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label>Questions</label>
                            <input type="text" class="form-control" name="question">
                        </div>

                        <div class="form-group">
                            <label>Answers</label>
                            <textarea class="form-control" rows="4" name="answer"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add New Questions</button>

                        @if(session('faq_insert_status'))
                            <div class="alert alert-success mt-3">
                                {{ session('faq_insert_status') }}
                            </div>
                        @endif()

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
