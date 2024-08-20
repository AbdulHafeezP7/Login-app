@extends('backend.layouts.backendLayout')

@section('title', 'Department')

@section('content')
<!-- <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@43.0.0/build/ckeditor.min.js"></script> -->

<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Department</h1>
            <!-- Button to Open the Modal -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('departments.add')}}"><button type="button" class="btn btn-primary">
                    Add New Department
                </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
    
            <!-- Departments Table -->
            <table class="table table-bordered mt-4" id="departments-table">
                <thead>
                    <tr>
                        <th>Department (English)</th>
                        <th>Department (Arabic)</th>
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
var table = $('#departments-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('departments.dataTablesForDepartments') }}",
    columns: [
        { data: 'department_en', name: 'department_en' },
        { data: 'department_ar', name: 'department_ar' },
        { data: 'created_at', name: 'created_at' },
        {
            data: null,
            name: 'actions',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return `
                    <br><button type="button" class="btn btn-info view-department" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button><br>
                    <br><button type="button" class="btn btn-warning edit-department" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button><br>
                    <br><button type="button" class="btn btn-danger delete-department" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button><br>
                `;
            }
        }
    ],
    order: [[1, 'desc']]
});

    // View Department
$('#departments-table').on('click', '.view-department', function() {
    var departmentId = $(this).data('id');
    window.location.href = "{{ url('departments') }}/" + departmentId + "/show";
});

// Edit Department
$('#departments-table').on('click', '.edit-department', function() {
    var departmentId = $(this).data('id');
    window.location.href = "{{ url('departments') }}/" + departmentId + "/edit";
});

// Delete Department
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
                window.location.href = "{{route('departments.index')}}"; // Replace with the URL of the page you want to redirect to
              }, 0); // 2000 milliseconds = 2 seconds
            });
            // location.reload(); 
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
