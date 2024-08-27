@extends('backend.layouts.backendLayout')

@section('title', 'Edit Branch')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" /> -->

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Branch</h1>

            <form id="branch-form" class="needs-validation" novalidate action="{{ route('branchs.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="branchname_en" class="form-label">Branch Name(English)</label>
                    <input type="text" class="form-control" id="branchname_en" name="branchname_en" value="{{ old('branchname_en', $branch->branchname_en) }}">
                </div>

                <div class="mb-3">
                    <label for="branchname_ar" class="form-label">Branch Name(Arabic)</label>
                    <input type="text" class="form-control" id="branchname_ar" name="branchname_ar" value="{{ old('branchname_ar', $branch->branchname_ar) }}">
                </div>

                <div class="mb-3">
                    <label for="branchmanager_name" class="form-label">Branch Manager Name</label>
                    <input type="text" class="form-control" id="branchmanager_name" name="branchmanager_name" value="{{ old('branchmanager_name', $branch->branchmanager_name) }}">
                </div>

                <div class="mb-3">
                    <label for="branch_location" class="form-label">Branch Location</label>
                    <input type="text" class="form-control" id="branch_location" name="branch_location" value="{{ old('branch_location', $branch->branch_location) }}">
                </div>
                
                <div class="mb-3">
                    <label for="branch_address" class="form-label">Branch Address</label>
                    <textarea class="form-control" id="branch_address" name="branch_address" rows="4">{{ old('branch_address', $branch->branch_address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="branchsocial_link" class="form-label">Branch Social Media Link</label>
                    <input type="text" class="form-control" id="branchsocial_link" name="branchsocial_link" value="{{ old('branchsocial_link', $branch->branchsocial_link) }}">
                </div>

                <div class="mb-3">
                    <label for="branchoffice_number" class="form-label">Branch Office Number</label>
                    <input type="text" class="form-control" id="branchoffice_number" name="branchoffice_number" value="{{ old('branchoffice_number', $branch->branchoffice_number) }}">
                </div>

                <div class="mb-3">
                    <label for="branchmanager_number" class="form-label">Branch Manager Number</label>
                    <input type="text" class="form-control" id="branchmanager_number" name="branchmanager_number" value="{{ old('branchmanager_number', $branch->branchmanager_number) }}">
                </div>

                <!-- Hidden input fields for Quill editor content
                <input type="hidden" id="content_en_data" name="branch_en" value="{{ old('branch_en', $branch->branch_en) }}">
                <input type="hidden" id="content_ar_data" name="branch_en" value="{{ old('branch_en', $branch->branch_en) }}"> -->

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('branchs.index') }}" class="btn btn-secondary">Cancel</a>
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

        // const branchEnContent = $('#content_en_data').val();
        // const branchArContent = $('#content_ar_data').val();

        // snowEditor.root.innerHTML = branchEnContent;
        // snowEditor1.root.innerHTML = branchEnContent;

        $('#branch-form').on('submit', function(e) {
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
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Branch updated successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{route('branchs.index')}}"; // Replace with the URL of the page you want to redirect to
                            }, 0); // 2000 milliseconds = 2 seconds
                        });
                        // location.reload(); 
                    } else {
                        console.log('Error updating branch: ' + response.message);
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
                        console.log('Error updating branch: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        });
    });
</script>
@endsection