@extends('backend.layouts.backendLayout')
@section('title', 'Social Media')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Social Media</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('socialmedias.add')}}"><button type="button" class="btn btn-primary">
                        Add New Social Media
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="socialmedias-table">
                    <thead>
                        <tr>
                            <th>TikTok Name (English)</th>
                            <th>TikTok Image</th>
                            <th>Snapchat Name (English)</th>
                            <th>Snapchat Image</th>
                            <th>Instagram Name (English)</th>
                            <th>Instagram Image</th>
                            <th>Facebook Name (English)</th>
                            <th>Facebook Image</th>
                            <th>Youtube Name (English)</th>
                            <th>Youtube Image</th>
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
                url: "{{route('socialmedias.decrement')}}",
                data: {
                    socialmediaId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error decrementing socialmedia:', response.message);
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
                url: "{{route('socialmedias.increment')}}",
                data: {
                    socialmediaId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error incrementing socialmedia:', response.message);
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
        var table = $('#socialmedias-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('socialmedias.dataTablesForSocialmedias') }}",
            columns: [
                {
                    data: 'tiktok_name',
                    name: 'tiktok_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'tiktok_image',
                    name: 'tiktok_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'snapchat_name',
                    name: 'snapchat_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'snapchat_image',
                    name: 'snapchat_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'instagram_name',
                    name: 'instagram_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'instagram_image',
                    name: 'instagram_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'facebook_name',
                    name: 'facebook_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'facebook_image',
                    name: 'facebook_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'youtube_name',
                    name: 'youtube_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'youtube_image',
                    name: 'youtube_image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: auto;">`;
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
                    <button type="button" class="btn btn-info view-socialmedia" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-socialmedia" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-socialmedia" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [10, 'desc']
            ]
        });
        $('#socialmedias-table').on('click', '.view-socialmedia', function() {
            var socialmediaId = $(this).data('id');
            window.location.href = "{{ url('socialmedias') }}/" + socialmediaId + "/show";
        });
        $('#socialmedias-table').on('click', '.edit-socialmedia', function() {
            var socialmediaId = $(this).data('id');
            window.location.href = "{{ url('socialmedias') }}/" + socialmediaId + "/edit";
        });
        $('#socialmedias-table').on('click', '.delete-socialmedia', function() {
            var socialmediaId = $(this).data('id');
            if (confirm('Are you sure you want to delete this socialmedia?')) {
                $.ajax({
                    url: "{{ url('socialmedias') }}/" + socialmediaId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Socialmedia deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{route('socialmedias.index')}}";
                                }, 0);
                            });

                        } else {
                            console.log('Error deleting socialmedia: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting socialmedia: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection