@extends('Backend.Shared.layout')

@section('title', 'View Email')

@section('content')
    <div class="themed-box">
        <h2>Email Details</h2>

        <div class="mb-3">
            <label for="subject" class="form-label"><strong>Subject:</strong></label>
            <p>{{ $email->subject }}</p>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label"><strong>Body:</strong></label>
            <div class="border p-3" style="background-color: #f9f9f9;">
                <!-- Render CKEditor content as HTML -->
                {!! $email->body !!}
            </div>
        </div>

        <div class="mb-3">
            <label for="recipients" class="form-label"><strong>Recipients:</strong></label>
            <ul>
                @foreach ($email->recipients as $recipient)
                    <li>{{ $recipient->email }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label"><strong>Status:</strong></label>
            <p>{{ ucfirst($email->status) }}</p>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label"><strong>Sent Date:</strong></label>
            <p>{{ $email->date ? $email->date->format('Y-m-d H:i:s') : 'N/A' }}</p>
        </div>
    </div>
@endsection
