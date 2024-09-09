@extends('backend.layouts.backendLayout')
@section('title', 'AddSocialmedia')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Social Media</h5>
                    <div class="card-body">
                        <form id="addSocialmediaForm" class="is-invalid" novalidate action="{{ route('socialmedias.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="socialmedia_url" class="form-label">Socialmedia URL</label>
                                <input type="text" class="form-control" id="socialmedia_url" name="socialmedia_url">
                            </div>
                            <div class="mb-3" id="socialmediaImg">
                                <label for="socialmedia_image" class="form-label">Socialmedia Image</label>
                                <input type="file" class="form-control" id="socialmedia_image" name="socialmedia_image" accept="image/*">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('socialmedias.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="content" id="content">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
    <script src="{{ asset('assets/js/socialmedia-form-validation.js') }}"></script>
    <script>
        var socialmediaIndexUrl = "{{ route('socialmedias.index') }}";
        var socialmediaStoreUrl = "{{ route('socialmedias.store') }}";
    </script>
    @endsection