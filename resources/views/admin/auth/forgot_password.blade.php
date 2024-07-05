@extends('admin.layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
    <h3>Forgot Password</h3>

    <form method="post" action="{{ route('admin.auth.forgot_password.send-token') }}">
        @csrf
        <div class="form-group">
            <label for="email">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter email">
        </div>

        <a href="{{ route('admin.auth.login') }}">Back to login</a>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
