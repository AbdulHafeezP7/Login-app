@extends('backend.layouts.backendLayout')
@section('title', 'Edit Doctor')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Doctor</h1>
            <form id="doctor-form" class="is-invalid" novalidate action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$doctor->id}}">
                </div>
                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (English)</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $doctor->name_en) }}">
                </div>
                <div class="mb-3">
                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar', $doctor->name_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="doctor_description" class="form-label">Doctor Description</label>
                    <div id="doctor-description-toolbar">
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
                    <div id="doctor-description-editor"></div>
                    <input type="hidden" name="doctor_description" id="doctor_description" value="{{ old('doctor_description', $doctor->doctor_description) }}>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-control" id="department" name="department">
                        <option value="">Select a Department</option>
                        @foreach($departments as $data)
                        <option value="{{$data->id}}" {{ old('department', $doctor->department) == $data->id ? 'selected' : '' }}>
                            {{ $data->department_en }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Doctor Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($doctor->image)
                    <img src="{{ asset('images/' . $doctor->image) }}" alt="Doctor Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
<script src="{{ asset('assets/js/doctor-edit-validation.js') }}"></script>
<script>
     var doctorsIndexUrl = "{{ route('doctors.index') }}";
</script>

@endsection