<!-- Article Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Article')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Article</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('articles.add')}}"><button type="button" class="btn btn-primary">
                        Add New Article
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <!-- Table Content -->
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="articles-table">
                    <thead>
                        <tr>
                            <th>Title (English)</th>
                            <th>Title (Arabic)</th>
                            <th>Article (English)</th>
                            <th>Article (Arabic)</th>
                            <th>Tumbnail Image</th>
                            <th>Slug</th>
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
<!-- JS Link -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    // Sort Decrement Function
    function decrement(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('articles.decrement')}}",
                data: {
                    articleId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);

                        var table = $('#articles-table').DataTable();
                        table.ajax.reload();
                    } else {
                        console.error('Error decrementing article:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    }
    // Sort Increment Function
    function increment(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('articles.increment')}}",
                data: {
                    articleId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        var table = $('#articles-table').DataTable();
                        table.ajax.reload();
                    } else {
                        console.error('Error incrementing article:', response.message);
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
        // Datatable Content
        var table = $('#articles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('articles.dataTablesForArticles') }}",
            columns: [{
                    data: 'title_en',
                    name: 'title_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'title_ar',
                    name: 'title_ar',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'content_en',
                    name: 'content_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'content_ar',
                    name: 'content_ar',
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
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: null,
                    name: 'sort',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <button type="button" class="btn btn-info" onClick="increment(${row.id});" data-id="${row.id}"><i class="fa-solid fa-arrow-down"></i></button>
                    ${row.sort}
                    <button type="button" class="btn btn-info" onClick="decrement(${row.id});" data-id="${row.id}"><i class="fa-solid fa-arrow-up"></i></button>
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
                    <button type="button" class="btn btn-info view-article" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-article" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-article" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [7, 'desc']
            ]
        });
        // View Article
        $('#articles-table').on('click', '.view-article', function() {
            var articleId = $(this).data('id');
            window.location.href = "{{ url('articles') }}/" + articleId + "/show";
        });
        // Edit Article
        $('#articles-table').on('click', '.edit-article', function() {
            var articleId = $(this).data('id');
            window.location.href = "{{ url('articles') }}/" + articleId + "/edit";
        });
        // Delete Article
        $('#articles-table').on('click', '.delete-article', function() {
            var articleId = $(this).data('id');
            if (confirm('Are you sure you want to delete this article?')) {
                $.ajax({
                    url: "{{ url('articles') }}/" + articleId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Article deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                var table = $('#articles-table').DataTable();
                                table.ajax.reload();
                            });
                        } else {
                            console.log('Error deleting article: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting article: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection