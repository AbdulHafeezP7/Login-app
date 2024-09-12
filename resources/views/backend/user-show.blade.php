@extends('backend.layouts.backendLayout')
@section('title', 'View User')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Full Name:</h3>
            <div>{!! $user->name !!}</div>
            <h3 class="card-title">Email:</h3>
            <div>{!! $user->email !!}</div>
            <p><strong>Created at:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back to User</a>
        </div>
    </div>
</div>
@endsection