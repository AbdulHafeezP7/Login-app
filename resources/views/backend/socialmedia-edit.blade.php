@extends('backend.layouts.backendLayout')
@section('title', 'Edit Socialmedia')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Socialmedia</h1>
            <form id="socialmedia-form" class="is-invalid" novalidate action="{{ route('socialmedias.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="tiktok_name" class="form-label">TikTok Name (English)</label>
                    <input type="text" class="form-control" id="tiktok_name" name="tiktok_name" value="{{ old('tiktok_name', $socialmedia->tiktok_name) }}">
                </div>
                <div class="mb-3">
                    <label for="tiktok_image" class="form-label">TikTok Image</label>
                    <input type="file" class="form-control" id="tiktok_image" name="tiktok_image">
                    @if($socialmedia->tiktok_image)
                    <img src="{{ asset('images/' . $socialmedia->tiktok_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="snapchat_name" class="form-label">Snapchat Name (English)</label>
                    <input type="text" class="form-control" id="snapchat_name" name="snapchat_name" value="{{ old('snapchat_name', $socialmedia->snapchat_name) }}">
                </div>
                <div class="mb-3">
                    <label for="snapchat_image" class="form-label">Snapchat Image</label>
                    <input type="file" class="form-control" id="snapchat_image" name="snapchat_image">
                    @if($socialmedia->snapchat_image)
                    <img src="{{ asset('images/' . $socialmedia->snapchat_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="instagram_name" class="form-label">Instagram Name (English)</label>
                    <input type="text" class="form-control" id="instagram_name" name="instagram_name" value="{{ old('instagram_name', $socialmedia->instagram_name) }}">
                </div>
                <div class="mb-3">
                    <label for="instagram_image" class="form-label">Instagram Image</label>
                    <input type="file" class="form-control" id="instagram_image" name="instagram_image">
                    @if($socialmedia->instagram_image)
                    <img src="{{ asset('images/' . $socialmedia->instagram_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="facebook_name" class="form-label">Facebook Name (English)</label>
                    <input type="text" class="form-control" id="facebook_name" name="facebook_name" value="{{ old('facebook_name', $socialmedia->facebook_name) }}">
                </div>
                <div class="mb-3">
                    <label for="facebook_image" class="form-label">Facebook Image</label>
                    <input type="file" class="form-control" id="facebook_image" name="facebook_image">
                    @if($socialmedia->facebook_image)
                    <img src="{{ asset('images/' . $socialmedia->facebook_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="youtube_name" class="form-label">Youtube Name (English)</label>
                    <input type="text" class="form-control" id="youtube_name" name="youtube_name" value="{{ old('youtube_name', $socialmedia->youtube_name) }}">
                </div>
                <div class="mb-3">
                    <label for="youtube_image" class="form-label">Youtube Image</label>
                    <input type="file" class="form-control" id="youtube_image" name="youtube_image">
                    @if($socialmedia->youtube_image)
                    <img src="{{ asset('images/' . $socialmedia->youtube_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('socialmedias.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/socialmedia-edit-validation.js') }}"></script>
<script>
     var socialmediaIndexUrl = "{{ route('socialmedias.index') }}";
</script>
@endsection