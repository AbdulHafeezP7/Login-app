@extends('backend.layouts.backendLayout')
@section('title', 'View Branch')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Branch English Name:</h3>
            <div>{!! $singleBranch->branchname_en !!}</div>
            <h3 class="card-title">Branch Arabic Name:</h3>
            <div>{!! $singleBranch->branchname_ar !!}</div>
            <h3 class="card-title">Branch Manager Name:</h3>
            <div>{!! $singleBranch->branchmanager_name !!}</div>
            <h3 class="card-title">Branch Location:</h3>
            <div>{!! $singleBranch->branch_location !!}</div>
            <h3 class="card-title">Branch Address:</h3>
            <div>{!! $singleBranch->branch_address !!}</div>
            <h3 class="card-title">Branch Social Media Link:</h3>
            <div>{!! $singleBranch->branchsocial_link !!}</div>
            <h3 class="card-title">Branch Office Number:</h3>
            <div>{!! $singleBranch->branchoffice_number !!}</div>
            <h3 class="card-title">Branch Manager Number:</h3>
            <div>{!! $singleBranch->branchmanager_number !!}</div>
            <p><strong>Created at:</strong> {{ $singleBranch->created_at->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('branchs.index') }}" class="btn btn-primary">Back to Branch</a>
        </div>
    </div>
</div>
@endsection