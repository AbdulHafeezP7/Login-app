@extends('backend.layouts.backendLayout')
@section('title', 'AddSocialmedia')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Social Media</h5>
                    <div class="card-body">
                        <form id="addSocialmediaForm" class="is-invalid" novalidate action="{{ route('socialmedias.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tiktok_name" class="form-label">TikTok Name (English)</label>
                                <input type="text" class="form-control" id="tiktok_name" name="tiktok_name">
                            </div>
                            <div class="mb-3" id="tiktokImg">
                                <label for="tiktok_image" class="form-label">TikTok Image</label>
                                <input type="file" class="form-control" id="tiktok_image" name="tiktok_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="snapchat_name" class="form-label">Snapchat Name (English)</label>
                                <input type="text" class="form-control" id="snapchat_name" name="snapchat_name">
                            </div>
                            <div class="mb-3" id="snapchatImg">
                                <label for="snapchat_image" class="form-label">Snapchat Image</label>
                                <input type="file" class="form-control" id="snapchat_image" name="snapchat_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="instagram_name" class="form-label">Instagram Name (English)</label>
                                <input type="text" class="form-control" id="instagram_name" name="instagram_name">
                            </div>
                            <div class="mb-3" id="instagramImg">
                                <label for="instagram_image" class="form-label">Instagram Image</label>
                                <input type="file" class="form-control" id="instagram_image" name="instagram_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="facebook_name" class="form-label">Facebook Name (English)</label>
                                <input type="text" class="form-control" id="facebook_name" name="facebook_name">
                            </div>
                            <div class="mb-3" id="facebookImg">
                                <label for="facebook_image" class="form-label">Facebook Image</label>
                                <input type="file" class="form-control" id="facebook_image" name="facebook_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="youtube_name" class="form-label">Youtube Name (English)</label>
                                <input type="text" class="form-control" id="youtube_name" name="youtube_name">
                            </div>
                            <div class="mb-3" id="youtubeImg">
                                <label for="youtube_image" class="form-label">Facebook Image</label>
                                <input type="file" class="form-control" id="youtube_image" name="youtube_image" accept="image/*">
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('socialmedias.index') }}" class="btn btn-secondary">Cancel</a>
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
            $('#addSocialmediaForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('socialmedias.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Social Media created successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                window.location.href = "{{route('socialmedias.index')}}";
                            });
                        } else {
                            console.log('Error saving socialmedia: ' + response.message);
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
                            console.log('Error saving socialmedia: ' + (xhr.responseJSON.message || 'Unknown error'));
                        }
                    }
                });
            });
        });
    </script>
    @endsection