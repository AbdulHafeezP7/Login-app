@extends('backend.layouts.backendLayout')
@section('title', 'View Doctor')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">English Name:</h3>
            <div>{!! $doctor->name_en !!}</div>
            <h3 class="card-title">Arabic Name:</h3>
            <div>{!! $doctor->name_ar !!}</div>
            <h3 class="card-title">Doctor Description:</h3>
            <div>{!! $doctor->doctor_description !!}</div>
            <div>
                <h3>Doctor Image</h3>
                @if($doctor->image)
                <img src="{{ asset('images/' . $doctor->image) }}" alt="Doctor Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <h3>Department:</h3>
            <div>{!! $doctor->department !!}</div>
            <p><strong>Created at:</strong> {{ $doctor->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Back to Doctors</a>
        </div>
    </div>
</div>
@endsection