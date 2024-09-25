<!-- Partner Show/View Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'View Socialmedia')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Socialmedia URL:</h3>
            <div>{!! $socialmedia->socialmedia_url !!}</div>
            <div>
                <h3>Socialmedia Image</h3>
                @if($socialmedia->socialmedia_image)
                <img src="{{ asset('images/' . $socialmedia->socialmedia_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <p><strong>Created at:</strong> {{ $socialmedia->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('socialmedias.index') }}" class="btn btn-primary">Back to Socialmedia</a>
        </div>
    </div>
</div>
@endsection