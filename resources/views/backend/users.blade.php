<!-- Social Media Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'User')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">User</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('users.add')}}"><button type="button" class="btn btn-primary">
                        Add New User
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <!-- Table Content -->
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="users-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
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
    // Sort Decrement Funtion
    function decrement(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('users.decrement')}}",
                data: {
                    userId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error decrementing user:', response.message);
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
                url: "{{route('users.increment')}}",
                data: {
                    userId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error incrementing user:', response.message);
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
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.dataTablesForUsers') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data) {
                        return data ? data.substring() + '' : '';
                    }
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return data ? data.substring() + '' : '';
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
                    <button type="button" class="btn btn-info view-user" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-user" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-user" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="btn btn-primary passwordreset-user" data-id="${row.id}"><i class="fa-solid fa-unlock"></i></button>
                `;
                    }
                }
            ],
            order: [
                [2, 'desc']
            ]
        });
        // View User
        $('#users-table').on('click', '.view-user', function() {
            var userId = $(this).data('id');
            window.location.href = "{{ url('users') }}/" + userId + "/show";
        });
        // Edit User
        $('#users-table').on('click', '.edit-user', function() {
            var userId = $(this).data('id');
            window.location.href = "{{ url('users') }}/" + userId + "/edit";
        });
        // Password Reset User
        $('#users-table').on('click', '.passwordreset-user', function() {
            var userId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to reset this user's password?",
                icon: 'warning',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light',
                    cancelButton: 'btn btn-danger waves-effect waves-light'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('users') }}/" + userId + "/passwordreset";
                }
            });
        });
        // Delete User
        $('#users-table').on('click', '.delete-user', function() {
            var userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: "{{ url('users') }}/" + userId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'User deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{route('users.index')}}";
                                }, 0);
                            });

                        } else {
                            console.log('Error deleting user: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting user: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection