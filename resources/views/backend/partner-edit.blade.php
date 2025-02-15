<!-- Partner Edit Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Edit Partner')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Partner</h1>
            <!-- Form Start -->
            <form id="partner-form" class="is-invalid" novalidate action="{{ route('partners.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="partner_en" class="form-label">Partner Name(English)</label>
                    <input type="text" class="form-control" id="partner_en" name="partner_en" value="{{ old('partner_en', $singlePartner->partner_en) }}">
                </div>
                <div class="mb-3">
                    <label for="partner_ar" class="form-label">Partner Name(Arabic)</label>
                    <input type="text" class="form-control" id="partner_ar" name="partner_ar" value="{{ old('partner_ar', $singlePartner->partner_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Partner Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($singlePartner->image)
                    <img src="{{ asset('images/' . $singlePartner->image) }}" alt="Partner Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('partners.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>
<!-- JS Link -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/partner-edit-validation.js') }}"></script>
<script>
    // Route For Partner Index
     var partnerIndexUrl = "{{ route('partners.index') }}";
</script>
@endsection