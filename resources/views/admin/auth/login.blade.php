@extends('admin.layouts.auth')

@section('title')
    Login
@endsection

@section('content')
<h3>Login</h3>

<form method="post" action="{{ route('admin.auth.login.verify') }}">
    @csrf
    <div class="form-group">
        <label for="email">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <a href="{{ route('admin.auth.forgot_password') }}">Forgot password?</a>
    <br>
    <br>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection
