@extends('backend.layouts.backendLayout')
@section('title', 'AddOffer')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <h5 class="card-header">Add Offer</h5>
                    <div class="card-body">
                        <form id="addOfferForm" class="is-invalid" novalidate action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="offer_en" class="form-label">Offer Name(English)</label>
                                <input type="text" class="form-control" id="offer_en" name="offer_en">
                            </div>
                            <div class="mb-3">
                                <label for="offer_ar" class="form-label">Offer Name(Arabic)</label>
                                <input type="text" class="form-control" id="offer_ar" name="offer_ar">
                            </div>
                            <div class="mb-3" id="offerImg">
                                <label for="image" class="form-label">Offer Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="actual_price" class="form-label">Actual Price</label>
                                <input type="number" class="form-control" id="actual_price" name="actual_price" aria-label="actual_price" fdprocessedid="2ibxem">
                            </div>
                            <div class="mb-3">
                                <label for="offer_price" class="form-label">Offer Price</label>
                                <input type="number" class="form-control" id="offer_price" name="offer_price" aria-label="actual_price" fdprocessedid="2ibxem">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
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
            $('#addOfferForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('offers.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Offer created successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                window.location.href = "{{route('offers.index')}}";
                            });
                        } else {
                            console.log('Error saving offer: ' + response.message);
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
                            console.log('Error saving article: ' + (xhr.responseJSON.message || 'Unknown error'));
                        }
                    }
                });
            });
        });
    </script>
    @endsection