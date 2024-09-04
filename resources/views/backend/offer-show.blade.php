@extends('backend.layouts.backendLayout')
@section('title', 'View Offer')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Offer English Name:</h3>
            <div>{!! $offer->offer_en !!}</div>
            <h3 class="card-title">Offer Arabic Name:</h3>
            <div>{!! $offer->offer_ar !!}</div>
            <div>
                <h3>Offer Image</h3>
                @if($offer->image)
                <img src="{{ asset('images/' . $offer->image) }}" alt="Offer Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Actual Price:</h3>
            <div>{!! $offer->actual_price !!}</div>
            <h3 class="card-title">Offer Price:</h3>
            <div>{!! $offer->offer_price !!}</div>
            <p><strong>Created at:</strong> {{ $offer->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('offers.index') }}" class="btn btn-primary">Back to Offers</a>
        </div>
    </div>
</div>
@endsection