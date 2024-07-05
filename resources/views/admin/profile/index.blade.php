@extends('admin.layouts.panel')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="mt-6">
        <div class="container">
            <h2 style="text-align: center;">Edit Admin</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $admin->username) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="country_code">Country Code</label>
                    <select class="form-control" id="country_code" name="country_id" required>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }} {{ $admin->country_code == $country->country_code ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $admin->phone_number) }}" required>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>
    <br>
    <br>
    <br>
    <main class="mt-6">
        <div class="container">
            <h2 style="text-align: center;">Update password</h2>
            <form action="{{ route('admin.profile.update_password') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <br>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>
@endsection
