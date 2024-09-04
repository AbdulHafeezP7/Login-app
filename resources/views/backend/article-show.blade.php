@extends('backend.layouts.backendLayout')
@section('title', 'View Article')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">English Title:</h3>
            <div>{!! $article->title_en !!}</div>
            <h3 class="card-title">Arabic Title:</h3>
            <div>{!! $article->title_ar !!}</div>
            <div>
                <h3>Article Image</h3>
                @if($article->image)
                <img src="{{ asset('images/' . $article->image) }}" alt="Article Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3>English Content:</h3>
            <div>{!! $article->article_en !!}</div>
            <h3>Arabic Content:</h3>
            <div>{!! $article->article_ar !!}</div>
            <p><strong>Slug:</strong> {{ $article->slug }}</p>
            <p><strong>Created at:</strong> {{ $article->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('articles.index') }}" class="btn btn-primary">Back to Articles</a>
        </div>
    </div>
</div>
@endsection