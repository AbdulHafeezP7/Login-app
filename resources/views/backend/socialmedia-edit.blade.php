<!-- Socialmedia Edit Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Edit Socialmedia')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Socialmedia</h1>
            <!-- Form Start -->
            <form id="socialmedia-form" class="is-invalid" novalidate action="{{ route('socialmedias.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="socialmedia_url" class="form-label">Socialmedia URL</label>
                    <input type="text" class="form-control" id="socialmedia_url" name="socialmedia_url" value="{{ old('socialmedia_url', $socialmedia->socialmedia_url) }}">
                </div>
                <div class="mb-3">
                    <label for="socialmedia_image" class="form-label">Socialmedia Image</label>
                    <input type="file" class="form-control" id="socialmedia_image" name="socialmedia_image">
                    @if($socialmedia->socialmedia_image)
                    <img src="{{ asset('images/' . $socialmedia->socialmedia_image) }}" alt="Socialmedia Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('socialmedias.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>
<!-- JS Link -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/socialmedia-edit-validation.js') }}"></script>
<script>
    // Route For Socialmedia Index
     var socialmediaIndexUrl = "{{ route('socialmedias.index') }}";
</script>
@endsection