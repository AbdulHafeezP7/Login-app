<!-- Insurance Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'Insurance')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Insurance</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('insurances.add')}}"><button type="button" class="btn btn-primary">
                        Add New Insurance
                    </button></a>
            </div>
            <div class="alert alert-dismissible fade show" role="alert" id="alert-box1" style="display: none;">
                <span id="alert-message"></span>
            </div>
            <!-- Table Content -->
            <div class="table-responsive">
                <table class="table table-bordered mt-4" id="insurances-table">
                    <thead>
                        <tr>
                            <th>Insurance Name (English)</th>
                            <th>Insurance Name (Arabic)</th>
                            <th>Insurance Image</th>
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
    // Sort Decrement Funtion
    function decrement(id) {
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{route('insurances.decrement')}}",
                data: {
                    insuranceId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error decrementing insurance:', response.message);
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
                url: "{{route('insurances.increment')}}",
                data: {
                    insuranceId: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        console.log(response.message);
                        location.reload();
                    } else {
                        console.error('Error incrementing insurance:', response.message);
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
        var table = $('#insurances-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('insurances.dataTablesForInsurances') }}",
            columns: [{
                    data: 'insurance_en',
                    name: 'insurance_en',
                    render: function(data) {
                        return data ? data.substring(0, 13) + '' : '';
                    }
                },
                {
                    data: 'insurance_ar',
                    name: 'insurance_ar',
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
                    <button type="button" class="btn btn-info view-insurance" data-id="${row.id}"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" class="btn btn-warning edit-insurance" data-id="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger delete-insurance" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
                `;
                    }
                }
            ],
            order: [
                [3, 'desc']
            ]
        });
        // View Insurance
        $('#insurances-table').on('click', '.view-insurance', function() {
            var insuranceId = $(this).data('id');
            window.location.href = "{{ url('insurances') }}/" + insuranceId + "/show";
        });
        // Edit Insurance
        $('#insurances-table').on('click', '.edit-insurance', function() {
            var insuranceId = $(this).data('id');
            window.location.href = "{{ url('insurances') }}/" + insuranceId + "/edit";
        });
        // Delete Insurance
        $('#insurances-table').on('click', '.delete-insurance', function() {
            var insuranceId = $(this).data('id');
            if (confirm('Are you sure you want to delete this insurance?')) {
                $.ajax({
                    url: "{{ url('insurances') }}/" + insuranceId + "/delete",
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Insurance deleted successfully!',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                setTimeout(() => {
                                    window.location.href = "{{route('insurances.index')}}";
                                }, 0);
                            });

                        } else {
                            console.log('Error deleting insurance: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error deleting insurance: ' + (xhr.responseJSON.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection