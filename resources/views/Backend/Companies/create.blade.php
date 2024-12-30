@extends('Backend.Shared.layout')

@section('title', 'Create Company')

@section('content')
    <div class="container mt-4">
        <h2>Create New Company</h2>

        <form action="{{ route('admin.companies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Company</button>
        </form>
    </div>
@endsection
