<!-- Branch Edit Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Edit Branch')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Branch</h1>
            <!-- Form Start -->
            <form id="branch-form" class="is-invalid" novalidate action="{{ route('branchs.update', $singleBranch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="branchname_en" class="form-label">Branch Name(English)</label>
                    <input type="text" class="form-control" id="branchname_en" name="branchname_en" value="{{ old('branchname_en', $singleBranch->branchname_en) }}">
                </div>
                <div class="mb-3">
                    <label for="branchname_ar" class="form-label">Branch Name(Arabic)</label>
                    <input type="text" class="form-control" id="branchname_ar" name="branchname_ar" value="{{ old('branchname_ar', $singleBranch->branchname_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="branchmanager_name" class="form-label">Branch Manager Name</label>
                    <input type="text" class="form-control" id="branchmanager_name" name="branchmanager_name" value="{{ old('branchmanager_name', $singleBranch->branchmanager_name) }}">
                </div>
                <div class="mb-3">
                    <label for="branch_location" class="form-label">Branch Location</label>
                    <input type="text" class="form-control" id="branch_location" name="branch_location" value="{{ old('branch_location', $singleBranch->branch_location) }}">
                </div>
                <div class="mb-3">
                    <label for="branch_address" class="form-label">Branch Address</label>
                    <textarea class="form-control" id="branch_address" name="branch_address" rows="4">{{ old('branch_address', $singleBranch->branch_address) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="branchsocial_link" class="form-label">Branch Social Media Link</label>
                    <select class="form-control" id="branchsocial_link" name="branchsocial_link">
                        <option value="">Select a Branch Social Media Link</option>
                        @foreach($socialmedias as $data)
                        <option value="{{$data->id}}" {{ old('branchsocial_link', $singleBranch->branchsocial_link) == $data->id ? 'selected' : '' }}>
                            {{ $data->socialmedia_url }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="branchoffice_number" class="form-label">Branch Office Number</label>
                    <input type="text" class="form-control" id="branchoffice_number" name="branchoffice_number" value="{{ old('branchoffice_number', $singleBranch->branchoffice_number) }}">
                </div>
                <div class="mb-3">
                    <label for="branchmanager_number" class="form-label">Branch Manager Number</label>
                    <input type="text" class="form-control" id="branchmanager_number" name="branchmanager_number" value="{{ old('branchmanager_number', $singleBranch->branchmanager_number) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('branchs.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>
<!-- JS Link -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/branch-edit-validation.js') }}"></script>
<script>
    // Route For Branch Index
     var branchIndexUrl = "{{ route('branchs.index') }}";
</script>
@endsection