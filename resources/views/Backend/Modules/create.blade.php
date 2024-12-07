@extends('Backend.Shared.layout')

@section('title', 'Create Module')

@section('content')
    <div class="container mt-5">
        <h2>Create New Module</h2>
        <form action="{{ route('admin.modules.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Module Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter module name"
                    required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Create Module</button>
                <a href="{{ route('admin.modules') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
