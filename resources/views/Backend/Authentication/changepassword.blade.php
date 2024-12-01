@extends('Backend.Shared.layout')

@section('content')
    <div class="container">
        <h2>Change Password and Email</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.update.settings') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">New Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', auth()->user()->email ?? '') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
                @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
        </form>
    </div>
@endsection
