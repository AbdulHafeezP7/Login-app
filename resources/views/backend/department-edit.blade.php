@extends('backend.layouts.backendLayout')

@section('title', 'Edit Department')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" /> -->

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Department</h1>

            <form id="department-form" action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="department_en" class="form-label">Department (English)</label>
                    <input type="text" class="form-control" id="department_en" name="department_en" value="{{ old('department_en', $department->department_en) }}" required>
                </div>

                <div class="mb-3">
                    <label for="department_ar" class="form-label">Department (Arabic)</label>
                    <input type="text" class="form-control" id="department_ar" name="department_ar" value="{{ old('department_ar', $department->department_ar) }}" required>
                </div>


                <!-- Hidden input fields for Quill editor content
                <input type="hidden" id="content_en_data" name="department_en" value="{{ old('department_en', $department->department_en) }}">
                <input type="hidden" id="content_ar_data" name="department_ar" value="{{ old('department_ar', $department->department_ar) }}"> -->


                <!-- <div class="mb-3">
                    <label for="image" class="form-label">Department Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($department->image)
                        <img src="{{ asset('images/' . $department->image) }}" alt="Department Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div> -->

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>

<script>
$(document).ready(function () {
    // const snowEditor = new Quill('#snow-editor', {
    //     bounds: '#snow-editor',
    //     modules: {
    //         formula: true,
    //         toolbar: '#snow-toolbar'
    //     },
    //     theme: 'snow'
    // });

    // const snowEditor1 = new Quill('#snow-editor1', {
    //     bounds: '#snow-editor1',
    //     modules: {
    //         formula: true,
    //         toolbar: '#snow-toolbar1'
    //     },
    //     theme: 'snow'
    // });

    // const departmentEnContent = $('#content_en_data').val();
    // const departmentArContent = $('#content_ar_data').val();

    // snowEditor.root.innerHTML = departmentEnContent;
    // snowEditor1.root.innerHTML = departmentArContent;

    $('#department-form').on('submit', function (e) {
        e.preventDefault();
        
        // // Update hidden fields with Quill editor content
        // $('#content_en_data').val(snowEditor.root.innerHTML);
        // $('#content_ar_data').val(snowEditor1.root.innerHTML);

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
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
                window.location.href = "{{route('departments.index')}}"; // Replace with the URL of the page you want to redirect to
              }, 0); // 2000 milliseconds = 2 seconds
            });
            // location.reload(); 
         } else {
             console.log('Error updating department: ' + response.message);
         }
            },
            error: function(xhr) {
        console.log('Error updating department: ' + (xhr.responseJSON.message || 'Unknown error'));
     }
        });
    });
});
</script>
@endsection
