<!-- resources/views/home.blade.php -->
@extends('backend.layouts.backendLayout')

@section('title', 'AddDoctor')

@section('content')

<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" /> -->

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <!-- Snow Theme -->
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Doctor</h5>
                    <div class="card-body">
                        <form id="addDoctorForm" action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">Name (English)</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="Dr. " required>
                            </div>
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">Name (Arabic)</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" value="Dr. " required>
                            </div>


                            <div class="mb-3" id="doctorImg">
                                <label for="image" class="form-label">Doctor Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3" id="imgdiv" style="display: none;">
                                <img id="doctorImage" src="" alt="" width="100px" height="100px">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-control" id="department" name="department" required>
                                    <option value="">Select a Department</option>
                                    @foreach($departments as $id=> $department_en)
                                    <option value="{{$id}}">{{$department_en}}</option>
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


    <script>
        $(document).ready(function() {
            $('#addDoctorForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('doctors.store') }}", // Ensure this is the correct URL
                    type: 'POST', // Ensure the request method is POST
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
                        console.log('Error saving doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            });
        });
    </script>
    @endsection