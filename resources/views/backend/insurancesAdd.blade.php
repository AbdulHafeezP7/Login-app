@extends('backend.layouts.backendLayout')
@section('title', 'AddInsurance')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Insurance</h5>
                    <div class="card-body">
                        <form id="addInsuranceForm" class="is-invalid" novalidate action="{{ route('insurances.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="insurance_en" class="form-label">Insurance Name(English)</label>
                                <input type="text" class="form-control" id="insurance_en" name="insurance_en">
                            </div>
                            <div class="mb-3">
                                <label for="insurance_ar" class="form-label">Insurance Name(Arabic)</label>
                                <input type="text" class="form-control" id="insurance_ar" name="insurance_ar">
                            </div>
                            <div class="mb-3" id="insuranceImg">
                                <label for="image" class="form-label">Insurance Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('insurances.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#addInsuranceForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('insurances.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Insurance created successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                window.location.href = "{{route('insurances.index')}}";
                            });
                        } else {
                            console.log('Error saving insurance: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.invalid-feedback').remove();
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                let errorMessage = errors[field][0];
                                let inputField = $('#' + field);
                                let errorDiv = $('<div>').addClass('invalid-feedback').text(errorMessage);
                                inputField.after(errorDiv);
                                inputField.addClass('is-invalid');
                            }
                        } else {
                            console.log('Error saving insurance: ' + (xhr.responseJSON.message || 'Unknown error'));
                        }
                    }
                });
            });
        });
    </script>
    @endsection