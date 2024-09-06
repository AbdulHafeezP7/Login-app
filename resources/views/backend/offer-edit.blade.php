@extends('backend.layouts.backendLayout')
@section('title', 'Edit Offer')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Offer</h1>
            <form id="offer-form" class="is-invalid" novalidate action="{{ route('offers.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="offer_en" class="form-label">Offer Name(English)</label>
                    <input type="text" class="form-control" id="offer_en" name="offer_en" value="{{ old('offer_en', $offer->offer_en) }}">
                </div>
                <div class="mb-3">
                    <label for="offer_ar" class="form-label">Offer Name(Arabic)</label>
                    <input type="text" class="form-control" id="offer_ar" name="offer_ar" value="{{ old('offer_ar', $offer->offer_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Offer Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($offer->image)
                    <img src="{{ asset('images/' . $offer->image) }}" alt="Offer Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="actual_price" class="form-label">Actual Price</label>
                    <input type="text" class="form-control" id="actual_price" name="actual_price" value="{{ old('actual_price', $offer->actual_price) }}">
                </div>
                <div class="mb-3">
                    <label for="offer_price" class="form-label">Offer Price</label>
                    <input type="text" class="form-control" id="offer_price" name="offer_price" value="{{ old('offer_price', $offer->offer_price) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/offer-edit-validation.js') }}"></script>
<script>
     var offerIndexUrl = "{{ route('offers.index') }}";
</script>
@endsection