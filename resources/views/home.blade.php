@extends('layouts.starlight')

@section('title', 'Dashboard')

@section('dashboard-active', 'active')


@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">Starlight</a>
@endsection()

@section('content')
@if (Auth::user()->role == 1)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success text-center">
                        Total Users: {{ $users -> count() }}
                    </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Account Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop -> index + 1 }}</td>
                            <td>{{ $user -> name}}</td>
                            <td>{{ $user -> email}}</td>
                            <td>{{ $user -> created_at -> diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users -> links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @include('customer.dashboard')
@endif
@endsection
