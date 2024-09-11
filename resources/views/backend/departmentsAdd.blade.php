@extends('backend.layouts.backendLayout')
@section('title', 'AddDepartment')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Department</h5>
                    <div class="card-body">
                        <form id="addDepartmentForm" class="is-invalid" novalidate action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="department_en" class="form-label">Department(English)</label>
                                <input type="text" class="form-control" id="department_en" name="department_en">
                            </div>
                            <div class="mb-3">
                                <label for="department_ar" class="form-label">Department(Arabic)</label>
                                <input type="text" class="form-control" id="department_ar" name="department_ar">
                            </div>
                            <div class="mb-3" id="departmentImg">
                                <label for="image" class="form-label">Department Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="department_details" class="form-label">POPUp</label>
                                <textarea class="form-control" id="department_details" name="department_details" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug">
                            </div>
                            
                               <div class="mb-3">
                                <label for="doctor_description" class="form-label">Article(English)</label>
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
                                <div id="content_ar"></div>
                             </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <input type="hidden" name="content" id="content">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
    <script>
        var departmentIndexUrl = "{{ route('departments.index') }}";
        var departmentStoreUrl = "{{ route('departments.store') }}";
    </script>
     <script src="{{ asset('assets/js/department-form-validation.js') }}"></script>
    @endsection