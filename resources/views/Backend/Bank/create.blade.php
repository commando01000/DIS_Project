@extends('Backend.Shared.layout')

@section('title', 'Create Bank')

@section('content')
    <div class="container mt-5">
        <h2>Create New Bank</h2>
        <!-- Form for creating a new bank -->
        <form action="{{ route('admin.client.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Bank Name en</label>
                <input type="text" name="name_en" id="name" class="form-control" placeholder="Enter bank name en"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="name">Bank Name ar</label>
                <input type="text" name="name_ar" id="name" class="form-control" placeholder="Enter bank name ar"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="modules">Modules</label>
                <select name="modules[]" id="modules" class="form-control" multiple>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple
                    options.</small>
            </div>

            <div class="form-group mb-3">
                <label for="image">Bank Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload an image for the bank (optional).</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Create Bank</button>
                <a href="{{ route('admin.client') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        // Add any necessary JavaScript code here
    </script>
@endsection
