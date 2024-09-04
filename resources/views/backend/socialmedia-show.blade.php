@extends('backend.layouts.backendLayout')
@section('title', 'View Socialmedia')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">TikTok Name:</h3>
            <div>{!! $socialmedia->tiktok_name !!}</div>
            <div>
                <h3>TikTok Image</h3>
                @if($socialmedia->tiktok_image)
                <img src="{{ asset('images/' . $socialmedia->tiktok_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Snapchat Name:</h3>
            <div>{!! $socialmedia->snapchat_name !!}</div>
            <div>
                <h3>Snapchat Image</h3>
                @if($socialmedia->snapchat_image)
                <img src="{{ asset('images/' . $socialmedia->snapchat_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Instagram Name:</h3>
            <div>{!! $socialmedia->instagram_name !!}</div>
            <div>
                <h3>Instagram Image</h3>
                @if($socialmedia->instagram_image)
                <img src="{{ asset('images/' . $socialmedia->instagram_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Facebook Name:</h3>
            <div>{!! $socialmedia->facebook_name !!}</div>
            <div>
                <h3>Facebook Image</h3>
                @if($socialmedia->facebook_image)
                <img src="{{ asset('images/' . $socialmedia->facebook_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Youtube Name:</h3>
            <div>{!! $socialmedia->youtube_name !!}</div>
            <div>
                <h3>Youtube Image</h3>
                @if($socialmedia->youtube_image)
                <img src="{{ asset('images/' . $socialmedia->youtube_image) }}" alt="Socialmedia Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            
            <p><strong>Created at:</strong> {{ $socialmedia->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('socialmedias.index') }}" class="btn btn-primary">Back to Socialmedias</a>
        </div>
    </div>
</div>
@endsection