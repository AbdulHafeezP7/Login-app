@extends('backend.layouts.backendLayout')
@section('title', 'Reset Password')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-12">
        <div class="card mb-6">
          <h5 class="card-header">Reset Password for {{ $user->name }}</h5>
          <div class="card-body">
            <form action="{{ route('users.passwordreset.update', $user->id) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary">Reset Password</button>
                  <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

