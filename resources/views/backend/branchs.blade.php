@extends('backend.layouts.backendLayout')

@section('title', 'Branch')

@section('content')
<!-- <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@43.0.0/build/ckeditor.min.js"></script> -->

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Branch</h1>
            <!-- Button to Open the Modal -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('branchs.add')}}"><button type="button" class="btn btn-primary">
                        Add New Branch
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>

            <!-- Branchs Table -->
            <table class="table table-bordered mt-4" id="branchs-table">
                <thead>
                    <tr>
                        <th>Branch Name(English)</th>
                        <th>Branch Name(Arabic)</th>
                        <th>Branch Manager Name</th>
                        <th>Branch Location</th>
                        <th>Branch Address</th>
                        <th>Branch Social Media Link</th>
                        <th>Branch Office Number</th>
                        <th>Branch Manager Number</th>
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
        // Function to show alert messages
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

        // Initialize DataTable
        var table = $('#branchs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('branchs.dataTablesForBranchs') }}",
            columns: [{
                    data: 'branchname_en',
                    name: 'branchname_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branchname_ar',
                    name: 'branchname_ar',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branchmanager_name',
                    name: 'branchmanager_name',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branch_location',
                    name: 'branch_location',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branch_address',
                    name: 'branch_address',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branchsocial_link',
                    name: 'branchsocial_link',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branchoffice_number',
                    name: 'branchoffice_number',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'branchmanager_number',
                    name: 'branchmanager_number',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
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
                    <button type="button" class="btn btn-info view-branch" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-branch" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-branch" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [8, 'desc']
            ]
        });

        // View Branch
        $('#branchs-table').on('click', '.view-branch', function() {
            var branchId = $(this).data('id');
            window.location.href = "{{ url('branchs') }}/" + branchId + "/show";
        });

        // Edit Branch
        $('#branchs-table').on('click', '.edit-branch', function() {
            var branchId = $(this).data('id');
            window.location.href = "{{ url('branchs') }}/" + branchId + "/edit";
        });

        // Delete Branch
        $('#branchs-table').on('click', '.delete-branch', function() {
            var branchId = $(this).data('id');
            if (confirm('Are you sure you want to delete this branch?')) {
                $.ajax({
                    url: "{{ url('branchs') }}/" + branchId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Good job!',
                                text: 'Branch deleted successfully!',
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
                            console.log('Error deleting branch: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting branch: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection