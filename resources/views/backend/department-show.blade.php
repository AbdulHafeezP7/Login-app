@extends('backend.layouts.backendLayout')
@section('title', 'View Department')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Department English Name:</h3>
            <div>{!! $department->department_en !!}</div>
            <h3 class="card-title">Department Arabic Name:</h3>
            <div>{!! $department->department_ar !!}</div>
            <div>
                <h3>Department Image</h3>
                @if($department->image)
                <img src="{{ asset('images/' . $department->image) }}" alt="Department Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3 class="card-title">Department Details:</h3>
            <div>{!! $department->department_details !!}</div>
            <p><strong>Slug:</strong> {{ $department->slug }}</p>
            <p><strong>Created at:</strong> {{ $department->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('departments.index') }}" class="btn btn-primary">Back to Departments</a>
        </div>
    </div>
</div>
@endsection