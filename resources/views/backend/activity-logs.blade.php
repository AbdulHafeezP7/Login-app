@extends('backend.layouts.backendLayout')
@section('title', 'Activity Log')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Activity Log</h1>
            @include('backend.layouts.partials.sidebar')
            <div class="table-responsive">
                <table class="table table-bordered" id="activity-log-table">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Action</th>
                            <th>Agent</th>
                            <th>IP Address</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#activity-log-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: baseUrl + '/load-content/activities',
                columns: [{
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'agent',
                        name: 'agent'
                    },
                    {
                        data: 'ip_address',
                        name: 'ip_address'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                order: [
                    [4, 'desc']
                ]
            });
        });
    </script>
    @endsection