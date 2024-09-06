@extends('backend.layouts.backendLayout')
@section('title', 'Edit Partner')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Partner</h1>
            <form id="partner-form" class="is-invalid" novalidate action="{{ route('partners.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="partner_en" class="form-label">Partner Name(English)</label>
                    <input type="text" class="form-control" id="partner_en" name="partner_en" value="{{ old('partner_en', $partner->partner_en) }}">
                </div>
                <div class="mb-3">
                    <label for="partner_ar" class="form-label">Partner Name(Arabic)</label>
                    <input type="text" class="form-control" id="partner_ar" name="partner_ar" value="{{ old('partner_ar', $partner->partner_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Partner Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($partner->image)
                    <img src="{{ asset('images/' . $partner->image) }}" alt="Partner Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('partners.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/partner-edit-validation.js') }}"></script>
<script>
     var partnerIndexUrl = "{{ route('partners.index') }}";
</script>
@endsection