@extends('backend.layouts.backendLayout')
@section('title', 'Offer')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Offer</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('offers.add')}}"><button type="button" class="btn btn-primary">
                        Add New Offer
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="offers-table">
                    <thead>
                        <tr>
                            <th>Offer Name (English)</th>
                            <th>Offer Name (Arabic)</th>
                            <th>Offer Image</th>
                            <th>Actual Price</th>
                            <th>Offer Price</th>
                            <th>Sort</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    function decrement(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('offers.decrement')}}",
                data: {
                    offerId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error decrementing offer:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    }

    function increment(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('offers.increment')}}",
                data: {
                    offerId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error incrementing offer:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    }
    $(document).ready(function() {
        function showAlert(message, type, alertBoxId) {
            $('#' + alertBoxId + ' #alert-message').text(message);
            $('#' + alertBoxId).removeClass('alert-success alert-danger').addClass(`alert-${type}`).show();
            setTimeout(function() {
                $('#' + alertBoxId).fadeOut();
            }, 1000);
        }
        if (sessionStorage.getItem('addMessage')) {
            showAlert(sessionStorage.getItem('addMessage'), 'success', 'alert-box1');
            sessionStorage.removeItem('addMessage');
        }
        if (sessionStorage.getItem('editMessage')) {
            showAlert(sessionStorage.getItem('editMessage'), 'success', 'alert-box1');
            sessionStorage.removeItem('editMessage');
        }
        var table = $('#offers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('offers.dataTablesForOffers') }}",
            columns: [{
                    data: 'offer_en',
                    name: 'offer_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'offer_ar',
                    name: 'offer_ar',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'actual_price',
                    name: 'actual_price',
                    render: function(data) {
                        return data ? data.substring(0, 23) + '' : '';
                    }
                },
                {
                    data: 'offer_price',
                    name: 'offer_price',
                    render: function(data) {
                        return data ? data.substring(0, 23) + '' : '';
                    }
                },
                {
                    data: null,
                    name: 'sort',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <button type="button" class="btn btn-info" onClick="decrement(${row.id});" data-id="${row.id}"><i class="fa-solid fa-arrow-down"></i></button>
                    ${row.sort}
                    <button type="button" class="btn btn-info" onClick="increment(${row.id});" data-id="${row.id}"><i class="fa-solid fa-arrow-up"></i></button>
                `;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <button type="button" class="btn btn-info view-offer" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-offer" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-offer" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [5, 'desc']
            ]
        });
        $('#offers-table').on('click', '.view-offer', function() {
            var offerId = $(this).data('id');
            window.location.href = "{{ url('offers') }}/" + offerId + "/show";
        });
        $('#offers-table').on('click', '.edit-offer', function() {
            var offerId = $(this).data('id');
            window.location.href = "{{ url('offers') }}/" + offerId + "/edit";
        });
        $('#offers-table').on('click', '.delete-offer', function() {
            var offerId = $(this).data('id');
            if (confirm('Are you sure you want to delete this offer?')) {
                $.ajax({
                    url: "{{ url('offers') }}/" + offerId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Offer deleted successfully!',
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
                            console.log('Error deleting offer: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting offer: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection