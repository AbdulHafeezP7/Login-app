@extends('backend.layouts.backendLayout')
@section('title', 'Doctor')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@43.0.0/build/ckeditor.min.js"></script>
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Doctors</h1>

            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('doctors.add')}}"><button type="button" class="btn btn-primary">
                        Add New Doctor
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="doctors-table">
                    <thead>
                        <tr>
                            <th>Name (English)</th>
                            <th>Name (Arabic)</th>
                            <th>Doctor Description</th>
                            <th>Doctor Image</th>
                            <th>Department</th>
                            <th>Front Page</th>
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
                url: "{{route('doctors.decrement')}}",
                data: {
                    doctorId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error decrementing doctor:', response.message);
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
                url: "{{route('doctors.increment')}}",
                data: {
                    doctorId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error incrementing doctors:', response.message);
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
        var table = $('#doctors-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('doctors.dataTablesForDoctors') }}",
            columns: [{
                    data: 'name_en',
                    name: 'name_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'name_ar',
                    name: 'name_ar',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'doctor_description',
                    name: 'doctor_description',
                    render: function(data) {
                        return data ? data.substring(0, 23) + '' : '';
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return `<img src="${data}" style="width: 50px; height: 50px;">`;
                    }
                },
                {
                    data: 'department',
                    name: 'department'
                },
                {
                    data: 'frontpage',
                    name: 'frontpage',
                    render: function(data, type, row) {
                        var checked = row.frontpage == 1 ? 'checked' : '';
                        return `
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input toggle-frontpage" type="checkbox" style="width:100%" data-id="${row.id}" ${checked}>
                        </div>`;
                    },
                    orderable: false,
                    searchable: false
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
                    <button type="button" class="btn btn-info view-doctor" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-doctor" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-doctor" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [6, 'desc']
            ]
        });
        $('#doctors-table').on('change', '.toggle-frontpage', function() {
            var doctorId = $(this).data('id');
            var frontpageStatus = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ url('doctors') }}/" + doctorId + "/toggle-frontpage",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    frontpage: frontpageStatus
                },
                success: function(response) {
                    if (response.status) {
                        showAlert('frontpage status updated successfully!', 'success', 'alert-box1');
                    } else {
                        showAlert('Failed to update frontpage status.', 'danger', 'alert-box1');
                    }
                },
                error: function(xhr) {
                    showAlert('Error updating frontpage status: ' + (xhr.responseJSON.message || 'Unknown error'), 'danger', 'alert-box1');
                }
            });
        });


        $('#doctors-table').on('click', '.view-doctor', function() {
            var doctorId = $(this).data('id');
            window.location.href = "{{ url('doctors') }}/" + doctorId + "/show";
        });


        $('#doctors-table').on('click', '.edit-doctor', function() {
            var doctorId = $(this).data('id');
            window.location.href = "{{ url('doctors') }}/" + doctorId + "/edit";
        });


        $('#doctors-table').on('click', '.delete-doctor', function() {
            var doctorId = $(this).data('id');
            if (confirm('Are you sure you want to delete this doctor?')) {
                $.ajax({
                    url: "{{ url('doctors') }}/" + doctorId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Doctor deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{route('doctors.index')}}";
                                }, 0);
                            });
                        } else {
                            console.log('Error deleting doctor: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting doctor: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection