@extends('backend.layouts.backendLayout')
@section('title', 'AddDoctor')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Doctor</h5>
                    <div class="card-body">
                        <form id="addDoctorForm" class="needs-validation" novalidate action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                            <label for="name_en" class="form-label">Name (English)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name_en" name="name_en">
                            </div>
                            <label for="name_ar" class="form-label">Name (Arabic)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name_ar" name="name_ar">
                            </div>
                            <div class="mb-3" id="doctorImg">
                                <label for="image" class="form-label">Doctor Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="doctor_description" class="form-label">Doctor Description</label>
                                <textarea class="form-control" id="doctor_description" name="doctor_description" rows="4"></textarea>
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
            $('#addDoctorForm').on('submit', function(e) {
                e.preventDefault();
                var nameEnFull = $('#basic-addon11').text() + ' ' + $('#name_en').val();
                var nameArFull = $('#basic-addon11').text() + ' ' + $('#name_ar').val();
                var nameEnValue = $('#name_en').val().trim();
                var nameArValue = $('#name_ar').val().trim();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('doctors.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Doctor created successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                window.location.href = "{{route('doctors.index')}}";
                            });
                        } else {
                            console.log('Error saving doctor: ' + response.message);
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
                            console.log('Error saving doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                        }
                    }
                });
            });
        });
    </script>
    @endsection