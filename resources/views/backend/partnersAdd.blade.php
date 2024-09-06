@extends('backend.layouts.backendLayout')
@section('title', 'AddPartner')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Partner</h5>
                    <div class="card-body">
                        <form id="addPartnerForm" class="is-invalid" novalidate action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="partner_en" class="form-label">Partner Name(English)</label>
                                <input type="text" class="form-control" id="partner_en" name="partner_en">
                            </div>
                            <div class="mb-3">
                                <label for="partner_ar" class="form-label">Partner Name(Arabic)</label>
                                <input type="text" class="form-control" id="partner_ar" name="partner_ar">
                            </div>
                            <div class="mb-3" id="partnerImg">
                                <label for="image" class="form-label">Partner Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('partners.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script src="{{ asset('assets/js/partner-form-validation.js') }}"></script>
    <script>
        var partnerIndexUrl = "{{ route('partners.index') }}";
        var partnerStoreUrl = "{{ route('partners.store') }}";
    </script>
    @endsection