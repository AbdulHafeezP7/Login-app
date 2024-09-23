@extends('backend.layouts.backendLayout')
@section('title', 'Reset Password')
@section('content')
<div id="content-area">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Reset Password</h1>
            <form id="user-form" class="is-invalid" novalidate action="{{ route('users.passwordreset.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3" style="display:none;">
                    <label for="id" class="form-label">ID</label>
                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" />
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="hidden" name="content" id="content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{ asset('assets/js/user-passwordreset.js') }}"></script>
<script>
    var userIndexUrl = "{{ route('users.index') }}";
</script>
@endsection