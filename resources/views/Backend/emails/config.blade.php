@extends('Backend.Shared.layout')

@section('title', 'Mail Config')

@section('content')
    <div class="container">
        <h2 class="mt-4">Edit Mail Configuration</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('mail.config.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="MAIL_MAILER" class="form-label">Mailer</label>
                <input type="text" name="MAIL_MAILER" id="MAIL_MAILER" class="form-control"
                    value="{{ $mailConfig['MAIL_MAILER'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_HOST" class="form-label">Host</label>
                <input type="text" name="MAIL_HOST" id="MAIL_HOST" class="form-control"
                    value="{{ $mailConfig['MAIL_HOST'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_PORT" class="form-label">Port</label>
                <input type="number" name="MAIL_PORT" id="MAIL_PORT" class="form-control"
                    value="{{ $mailConfig['MAIL_PORT'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_USERNAME" class="form-label">Username</label>
                <input type="text" name="MAIL_USERNAME" id="MAIL_USERNAME" class="form-control"
                    value="{{ $mailConfig['MAIL_USERNAME'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_PASSWORD" class="form-label">Password</label>
                <input type="text" name="MAIL_PASSWORD" id="MAIL_PASSWORD" class="form-control"
                    value="{{ $mailConfig['MAIL_PASSWORD'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_ENCRYPTION" class="form-label">Encryption</label>
                <input type="text" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control"
                    value="{{ $mailConfig['MAIL_ENCRYPTION'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_FROM_ADDRESS" class="form-label">From Address</label>
                <input type="email" name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" class="form-control"
                    value="{{ $mailConfig['MAIL_FROM_ADDRESS'] }}" required>
            </div>

            <div class="mb-3">
                <label for="MAIL_FROM_NAME" class="form-label">From Name</label>
                <input type="text" name="MAIL_FROM_NAME" id="MAIL_FROM_NAME" class="form-control"
                    value="{{ $mailConfig['MAIL_FROM_NAME'] }}" required>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
    </div>
@endsection
