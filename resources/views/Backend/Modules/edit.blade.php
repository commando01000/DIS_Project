@extends('Backend.Shared.layout')

@section('title', 'Edit Module')

@section('content')
    <div class="themed-box">
        <h2>Edit Module</h2>

        <!-- Display errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.modules.update', $module->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Module Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Module Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $module->name) }}" required>
            </div>

            <!-- Save Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
