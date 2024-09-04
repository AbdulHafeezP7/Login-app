@extends('backend.layouts.backendLayout')
@section('title', 'View Partner')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Partner English Name:</h3>
            <div>{!! $partner->partner_en !!}</div>
            <h3 class="card-title">Partner Arabic Name:</h3>
            <div>{!! $partner->partner_ar !!}</div>
            <div>
                <h3>Partner Image</h3>
                @if($partner->image)
                <img src="{{ asset('images/' . $partner->image) }}" alt="Partner Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <p><strong>Created at:</strong> {{ $partner->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('partners.index') }}" class="btn btn-primary">Back to Partners</a>
        </div>
    </div>
</div>
@endsection