@extends('Backend.Shared.layout')

@section('title', 'Create Bank')

@section('content')
    <div name="create-project" class="themed-box" >
        <h2>Create New Client</h2>
        <!-- Form for creating a new bank -->
        <form action="{{ route('admin.client.store') }}" method="POST" enctype="multipart/form-data" data-form='create-project'>
            @csrf
            <div class="form-group mb-3">
                <label for="name">Client Name en</label>
                <input type="text" name="name_en" id="name" class="form-control" placeholder="Enter bank name en"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="name">Client Name ar</label>
                <input type="text" name="name_ar" id="name" class="form-control" placeholder="Enter bank name ar"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="name">Contract Date</label>
                <input type="date" name="contract_date" class="form-control" id="contract-date">
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
                <label for="image">Client Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <small class="form-text text-muted">Upload an image for the Client (optional).</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Create Client</button>
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
