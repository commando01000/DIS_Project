@extends('Backend.Shared.layout')

@section('title', 'Edit Bank')

@section('content')
    <div class="themed-box">
        <h2>Edit Client</h2>

        <!-- Form to edit the bank -->
        <form action="{{ route('admin.client.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <!-- Bank Name -->
            <div class="form-group mb-3">
                <label for="name_en">Client Name (English)</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $bank->name['en'] }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="name_ar">Client Name (Arabic)</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $bank->name['ar'] }}"
                    required>
            </div>

            <!-- Bank Image -->
            <div class="form-group mb-3">
                <label for="image">Client Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <label for="contract-date">Contract Date</label>
                <input type="date" name="contract_date" id="contract-date" class="form-control">
                @if ($bank->image)
                    <img src="{{ asset($bank->image) }}" alt="{{ $bank->name['en'] }}" class="img-fluid mt-2"
                        style="max-width: 150px;">
                @endif
            </div>

            <!-- Associated Modules -->
            <div class="form-group mb-3">
                <label for="modules">Modules</label>
                <select name="modules[]" id="modules" class="form-control" multiple>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}" @if (in_array($module->id, $bank->modules->pluck('id')->toArray())) selected @endif>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple
                    modules.</small>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Client</button>
                <a href="{{ route('admin.client') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
