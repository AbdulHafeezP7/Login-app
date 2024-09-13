@extends('backend.layouts.backendLayout')
@section('title', 'Edit Department')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Department</h1>
            <form id="department-form" class="is-invalid" novalidate action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="department_en" class="form-label">Department (English)</label>
                    <input type="text" class="form-control" id="department_en" name="department_en" value="{{ old('department_en', $department->department_en) }}">
                </div>
                <div class="mb-3">
                    <label for="department_ar" class="form-label">Department (Arabic)</label>
                    <input type="text" class="form-control" id="department_ar" name="department_ar" value="{{ old('department_ar', $department->department_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Department Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($department->image)
                    <img src="{{ asset('images/' . $department->image) }}" alt="Department Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="department_details" class="form-label">Department Details</label>
                    <textarea class="form-control" id="department_details" name="department_details" rows="4">{{ old('department_details', $department->department_details) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $department->slug) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>

                     <input type="hidden" value="{{old('content_ar', $department->content_ar) }}" name="content_ar_old" id="content_ar_old">
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/department-edit-validation.js') }}"></script>
<script>
     var departmentIndexUrl = "{{ route('departments.index') }}";
</script>

  
@endsection