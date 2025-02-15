<!-- Article Add Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Add Article')
@section('content')
<!-- CSS Link -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-12">
        <div class="card mb-6">
          <h5 class="card-header">Add Article</h5>
          <div class="card-body">
            <!-- Form Start -->
            <form id="addArticleForm" class="is-invalid" novalidate action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="title_en" class="form-label">Title(English)</label>
                <input type="text" class="form-control" id="title_en" name="title_en">
              </div>
              <div class="mb-3">
                <label for="title_ar" class="form-label">Title(Arabic)</label>
                <input type="text" class="form-control" id="title_ar" name="title_ar">
              </div>
              <!-- Editor -->
              <div class="mb-3">
                <label for="content_en" class="form-label">Article(English)</label>
                <div id="snow-toolbar">
                  <span class="ql-formats">
                    <select class="ql-font"></select>
                    <select class="ql-size"></select>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-strike"></button>
                  </span>
                  <span class="ql-formats">
                    <select class="ql-color"></select>
                    <select class="ql-background"></select>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-script" value="sub"></button>
                    <button class="ql-script" value="super"></button>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-header" value="1"></button>
                    <button class="ql-header" value="2"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                  </span>
                </div>
                <div id="snow-editor"></div>
                <div id="content_en"></div>
              </div>
              <!-- Editor -->
              <div class="mb-3">
                <label for="content_ar" class="form-label">Article(Arabic)</label>
                <div id="snow-toolbar1">
                  <span class="ql-formats">
                    <select class="ql-font"></select>
                    <select class="ql-size"></select>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-strike"></button>
                  </span>
                  <span class="ql-formats">
                    <select class="ql-color"></select>
                    <select class="ql-background"></select>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-script" value="sub"></button>
                    <button class="ql-script" value="super"></button>
                  </span>
                  <span class="ql-formats">
                    <button class="ql-header" value="1"></button>
                    <button class="ql-header" value="2"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                  </span>
                </div>
                <div id="snow-editor1"></div>
                <div id="content_ar"></div>
              </div>
              <div class="mb-3" id="articleImg">
                <label for="image" class="form-label">Article Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug">
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </div>
              <input type="hidden" name="content" id="content">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            <!-- Form End -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JS Link -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
  <script src="{{ asset('assets/js/article-form-validation.js') }}"></script>
  <script>
    // Route For Article Index And Store
    var articleIndexUrl = "{{ route('articles.index') }}";
    var articleStoreUrl = "{{ route('articles.store') }}";
  </script>
  @endsection