<!-- Branch Add Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Add Branch')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Branch</h5>
                    <div class="card-body">
                        <!-- Form Start -->
                        <form id="addBranchForm" class="is-invalid" novalidate action="{{ route('branchs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="branchname_en" class="form-label">Branch Name(English)</label>
                                <input type="text" class="form-control" id="branchname_en" name="branchname_en">
                            </div>
                            <div class="mb-3">
                                <label for="branchname_ar" class="form-label">Branch Name(Arabic)</label>
                                <input type="text" class="form-control" id="branchname_ar" name="branchname_ar">
                            </div>
                            <div class="mb-3">
                                <label for="branchmanager_name" class="form-label">Branch Manager Name</label>
                                <input type="text" class="form-control" id="branchmanager_name" name="branchmanager_name">
                            </div>
                            <div class="mb-3">
                                <label for="branch_location" class="form-label">Branch Location</label>
                                <input type="url" class="form-control" id="branch_location" name="branch_location">
                            </div>
                            <div class="mb-3">
                                <label for="branch_address" class="form-label">Branch Address</label>
                                <textarea class="form-control" id="branch_address" name="branch_address" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                    <label class="form-label" for="branchsocial_link">Branch Social Media Link</label>
                                    <select id="branchsocial_link" name="branchsocial_link" class="form-control select2 socialmedia" data-allow-clear="true">
                                    <option value="">Search Social Media Link</option>
                                    @foreach($socialmedias as $data)
                                    <option value="{{ $data->id }}">{{ $data->socialmedia_url }}</option>
                                    @endforeach
                                    </select>
                                    <span class="text-danger error-text socialmedia_error"></span>
                                </div>
                            <!-- <div class="mb-3">
                                <label for="branchsocial_link" class="form-label">Branch Social Media Link</label>
                                <select class="form-control select2 socialmedia" id="branchsocial_link" name="branchsocial_link" data-allow-clear="true">
                                    <option value="">Select a Branch Social Media Link</option>
                                    @foreach($socialmedias as $data)
                                    <option value="{{ $data->id }}">{{ $data->socialmedia_url }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text socialmedia_error"></span>
                            </div> -->
                            <div class="mb-3">
                                <label for="branchoffice_number" class="form-label">Branch Office Number</label>
                                <input type="tel" class="form-control" id="branchoffice_number" name="branchoffice_number">
                            </div>
                            <div class="mb-3">
                                <label for="branchmanager_number" class="form-label">Branch Manager Number</label>
                                <input type="tel" class="form-control" id="branchmanager_number" name="branchmanager_number">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('branchs.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script src="{{ asset('assets/js/branch-form-validation.js') }}"></script>
    <script>
        // Route For Branch Index And Store
        var branchIndexUrl = "{{ route('branchs.index') }}";
        var branchStoreUrl = "{{ route('branchs.store') }}";
    </script>
    @endsection