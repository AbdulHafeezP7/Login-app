@extends('backend.layouts.backendLayout')
@section('title', 'Department')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Department</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('departments.add')}}"><button type="button" class="btn btn-primary">
                        Add New Department
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <table class="table table-bordered mt-4" id="departments-table">
                <thead>
                    <tr>
                        <th>Department (English)</th>
                        <th>Department (Arabic)</th>
                        <th>Department Image</th>
                        <th>Department Details</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
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
        var table = $('#departments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('departments.dataTablesForDepartments') }}",
            columns: [{
                    data: 'department_en',
                    name: 'department_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'department_ar',
                    name: 'department_ar',
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
                    data: 'department_details',
                    name: 'department_details',
                    render: function(data) {
                        return data ? data.substring(0, 23) + '' : '';
                    }
                },
                {
                    data: 'slug',
                    name: 'slug'
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
                    <button type="button" class="btn btn-info view-department" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-department" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-department" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [5, 'desc']
            ]
        });
        $('#departments-table').on('click', '.view-department', function() {
            var departmentId = $(this).data('id');
            window.location.href = "{{ url('departments') }}/" + departmentId + "/show";
        });
        $('#departments-table').on('click', '.edit-department', function() {
            var departmentId = $(this).data('id');
            window.location.href = "{{ url('departments') }}/" + departmentId + "/edit";
        });
        $('#departments-table').on('click', '.delete-department', function() {
            var departmentId = $(this).data('id');
            if (confirm('Are you sure you want to delete this department?')) {
                $.ajax({
                    url: "{{ url('departments') }}/" + departmentId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Department deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{route('departments.index')}}";
                                }, 0);
                            });
                        } else {
                            console.log('Error deleting department: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting department: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection