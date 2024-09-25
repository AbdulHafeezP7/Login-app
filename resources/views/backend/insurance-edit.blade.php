<!-- Insurance Edit Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Edit Insurance')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Insurance</h1>
            <!-- Form Start -->
            <form id="insurance-form" class="is-invalid" novalidate action="{{ route('insurances.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="insurance_en" class="form-label">Insurance Name(English)</label>
                    <input type="text" class="form-control" id="insurance_en" name="insurance_en" value="{{ old('insurance_en', $singleInsurance->insurance_en) }}">
                </div>
                <div class="mb-3">
                    <label for="insurance_ar" class="form-label">Insurance Name(Arabic)</label>
                    <input type="text" class="form-control" id="insurance_ar" name="insurance_ar" value="{{ old('insurance_ar', $singleInsurance->insurance_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Insurance Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($singleInsurance->image)
                    <img src="{{ asset('images/' . $singleInsurance->image) }}" alt="Insurance Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('insurances.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>
<!-- JS Link -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/insurance-edit-validation.js') }}"></script>
<script>
    // Route For Insurance Index
     var insuranceIndexUrl = "{{ route('insurances.index') }}";
</script>
@endsection