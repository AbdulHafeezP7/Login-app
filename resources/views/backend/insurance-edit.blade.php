@extends('backend.layouts.backendLayout')
@section('title', 'Edit Insurance')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Insurance</h1>
            <form id="insurance-form" class="is-invalid" novalidate action="{{ route('insurances.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="insurance_en" class="form-label">Insurance Name(English)</label>
                    <input type="text" class="form-control" id="insurance_en" name="insurance_en" value="{{ old('insurance_en', $insurance->insurance_en) }}">
                </div>
                <div class="mb-3">
                    <label for="insurance_ar" class="form-label">Insurance Name(Arabic)</label>
                    <input type="text" class="form-control" id="insurance_ar" name="insurance_ar" value="{{ old('insurance_ar', $insurance->insurance_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Insurance Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($insurance->image)
                    <img src="{{ asset('images/' . $insurance->image) }}" alt="Insurance Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('insurances.index') }}" class="btn btn-secondary">Cancel</a>
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
        $('#insurance-form').on('submit', function(e) {
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
                            text: 'Insurance updated successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{route('insurances.index')}}";
                            }, 0);
                        });
                    } else {
                        console.log('Error updating insurance: ' + response.message);
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
                        console.log('Error updating insurance: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        });
    });
</script>
@endsection