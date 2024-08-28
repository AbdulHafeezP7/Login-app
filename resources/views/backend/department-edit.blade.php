@extends('backend.layouts.backendLayout')

@section('title', 'Edit Department')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" /> -->

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Department</h1>

            <form id="department-form" class="needs-validation" novalidate action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/form-validation.js') }}"></script>


<script>
    $(document).ready(function() {

        $('#department-form').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Department updated successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{route('departments.index')}}"; 
                            }, 0); 
                        });
                       
                    } else {
                        console.log('Error updating department: ' + response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    } else {
                        console.log('Error updating department: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        });
    });
</script>
@endsection