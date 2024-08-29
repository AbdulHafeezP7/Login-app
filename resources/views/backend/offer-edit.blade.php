@extends('backend.layouts.backendLayout')
@section('title', 'Edit Offer')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Offer</h1>
            <form id="offer-form" class="needs-validation" novalidate action="{{ route('offers.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="id" id="" value="{{$id}}">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" name="id" id="" value="{{$id}}">
                </div>
                <div class="mb-3">
                    <label for="offer_en" class="form-label">Offer Name(English)</label>
                    <input type="text" class="form-control" id="offer_en" name="offer_en" value="{{ old('offer_en', $offer->offer_en) }}">
                </div>
                <div class="mb-3">
                    <label for="offer_ar" class="form-label">Offer Name(Arabic)</label>
                    <input type="text" class="form-control" id="offer_ar" name="offer_ar" value="{{ old('offer_ar', $offer->offer_ar) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label"> Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($offer->image)
                    <img src="{{ asset('images/' . $offer->image) }}" alt="Offer Image" class="img-thumbnail mt-2" style="width: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="actual_price" class="form-label">Actual Price</label>
                    <input type="text" class="form-control" id="actual_price" name="actual_price" value="{{ old('actual_price', $offer->actual_price) }}">
                </div>
                <div class="mb-3">
                    <label for="offer_price" class="form-label">Offer Price</label>
                    <input type="text" class="form-control" id="offer_price" name="offer_price" value="{{ old('offer_price', $offer->offer_price) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
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
        $('#offer-form').on('submit', function(e) {
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
                            text: 'Offer updated successfully!',
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{route('offers.index')}}";
                            }, 0);
                        });
                    } else {
                        console.log('Error updating offer: ' + response.message);
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
                        console.log('Error updating offer: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                }
            });
        });
    });
</script>
@endsection