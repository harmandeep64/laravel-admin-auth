@extends('admin.layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
    <h3>Reset Password for {{ $email }}</h3>

    <form method="post" action="{{ route('admin.auth.reset_password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="New password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
        </div>

        <a href="{{ route('admin.auth.login') }}">Back to login</a>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
