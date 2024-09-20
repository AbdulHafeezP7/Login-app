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
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
              </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
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
