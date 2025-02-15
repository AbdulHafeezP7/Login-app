<!-- Doctor Add Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Add Doctor')
@section('content')
<!-- CSS Link -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Doctor</h5>
                    <div class="card-body">
                        <!-- Form Start -->
                        <form id="addDoctorForm" class="is-invalid" novalidate action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                            <label for="name_en" class="form-label">Name (English)</label>
                            <div class="mb-3">
                                <input type=" text" class="form-control" id="name_en" name="name_en">
                            </div>
                            <label for="name_ar" class="form-label">Name (Arabic)</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name_ar" name="name_ar">
                            </div>
                            <div class="mb-3" id="doctorImg">
                                <label for="image" class="form-label">Doctor Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <!-- Editor -->
                            <div class="mb-3">
                                <label for="doctor_description" class="form-label">Doctor Description</label>
                                <div id="snow-toolbar">
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
                                <div id="snow-editor"></div>
                                <div id="doctor_description"></div>
                            </div>
                            <div class="mb-3" id="imgdiv" style="display: none;">
                                <img id="doctorImage" src="" alt="" width="100px" height="100px">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-control" id="department" name="department">
                                    <option value="">Select a Department</option>
                                    @foreach($departments as $id=> $data)
                                    <option value="{{$data->id}}">{{$data->department_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="content" id="content">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS Link -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
    <script src="{{ asset('assets/js/doctor-form-validation.js') }}"></script>
    <script>
        // Route For Doctor Index And Store
        var doctorIndexUrl = "{{ route('doctors.index') }}";
        var doctorStoreUrl = "{{ route('doctors.store') }}";
    </script>
    @endsection