@extends('backend.layouts.backendLayout')
@section('title', 'Edit Article')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Article</h1>
            <form id="article-form" class="is-invalid" novalidate action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{ $article->id }}">
                </div>
                <div class="mb-3">
                    <label for="title_en" class="form-label">Title (English)</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $article->title_en) }}">
                </div>
                <div class="mb-3">
                    <label for="title_ar" class="form-label">Title (Arabic)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $article->title_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="article_en" class="form-label">Article(English)</label>
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
                <div class="mb-3">
                    <label for="article_ar" class="form-label">Article(Arabic)</label>
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
                <input type="hidden" id="content_en_data" name="article_en" value="{{ old('article_en', $article->article_en) }}">
                <input type="hidden" id="content_ar_data" name="article_ar" value="{{ old('article_ar', $article->article_ar) }}">

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $article->slug) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Thumbnail Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($article->image)
                    <img src="{{ asset('images/' . $article->image) }}" alt="Article Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/article-edit-validation.js') }}"></script>
<script>
    var articlesIndexUrl = "{{ route('articles.index') }}";
</script>

@endsection