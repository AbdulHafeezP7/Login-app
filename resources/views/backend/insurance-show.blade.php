<!-- Insurance Show/View Form -->
@extends('backend.layouts.backendLayout')
@section('title', 'View Insurance')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Insurance English Name:</h3>
            <div>{!! $singleInsurance->insurance_en !!}</div>
            <h3 class="card-title">Insurance Arabic Name:</h3>
            <div>{!! $singleInsurance->insurance_ar !!}</div>
            <div>
                <h3>Insurance Image</h3>
                @if($singleInsurance->image)
                <img src="{{ asset('images/' . $singleInsurance->image) }}" alt="Insurance Image" class="img-fluid mb-3" width="100px" height="100px">
                @endif
            </div>
            <p><strong>Created at:</strong> {{ $singleInsurance->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('insurances.index') }}" class="btn btn-primary">Back to Insurance</a>
        </div>
    </div>
</div>
@endsection