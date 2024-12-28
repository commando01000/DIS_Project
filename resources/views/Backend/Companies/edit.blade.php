@extends('Backend.Shared.layout')

@section('title', 'Edit Company')

@section('content')
    <div class="container mt-4">
        <h2>Edit Company</h2>

        <form action="{{ route('admin.companies.update', ['company_name' => $company['company_name']]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    value="{{ $company['company_name'] }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $company['email'] }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>
@endsection
