@extends('backend.layouts.backendLayout')
@section('title', 'Edit Doctor')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Doctor</h1>
            <form id="doctor-form" class="needs-validation" novalidate action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (English)</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $doctor->name_en) }}" >
                </div>
                <div class="mb-3">
                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar', $doctor->name_ar) }}" >
                </div>
                <div class="mb-3">
                    <label for="doctor_description" class="form-label">Doctor Description</label>
                    <textarea class="form-control" id="doctor_description" name="doctor_description" rows="4">{{ old('doctor_description', $doctor->doctor_description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-control" id="department" name="department" >
                        <option value="">Select a Department</option>
                        @foreach($departments as $id => $department_name)
                        <option value="{{ $id }}" {{ old('department', $doctor->department) == $id ? 'selected' : '' }}>
                            {{ $department_name }}
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
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#doctor-form').on('submit', function(e) {
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
                            text: 'Doctor updated successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{route('doctors.index')}}"; 
                            }, 0); 
                        });
                       
                    } else {
                        console.log('Error updating doctor: ' + response.message);
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
                        console.log('Error updating doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        });
    });
</script>
@endsection