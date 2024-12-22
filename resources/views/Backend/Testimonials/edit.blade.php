@extends('Backend.Shared.layout')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="themed-box">
        <h2>Edit Testimonial</h2>

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

        <!-- Form to edit the testimonial -->
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name_en" class="form-label">Name (English)</label>
                <input type="text" class="form-control" id="name_en" name="name[en]"
                    value="{{ old('name.en', $testimonial->name['en']) }}" required>
            </div>

            <div class="mb-3">
                <label for="name_ar" class="form-label">Name (Arabic)</label>
                <input type="text" class="form-control" id="name_ar" name="name[ar]"
                    value="{{ old('name.ar', $testimonial->name['ar']) }}" required>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role_en" class="form-label">Role (English)</label>
                <input type="text" class="form-control" id="role_en" name="role[en]"
                    value="{{ old('role.en', $testimonial->role['en']) }}" required>
            </div>

            <div class="mb-3">
                <label for="role_ar" class="form-label">Role (Arabic)</label>
                <input type="text" class="form-control" id="role_ar" name="role[ar]"
                    value="{{ old('role.ar', $testimonial->role['ar']) }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description_en" class="form-label">Description (English)</label>
                <textarea class="form-control" id="description_en" name="description[en]" rows="4" required>{{ old('description.en', $testimonial->description['en']) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="description_ar" class="form-label">Description (Arabic)</label>
                <textarea class="form-control" id="description_ar" name="description[ar]" rows="4" required>{{ old('description.ar', $testimonial->description['ar']) }}</textarea>
            </div>



            <!-- Social Media Links -->
            @include('Backend.Shared.social-media', ['links' => $testimonial])
            <!-- end -->
            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if ($testimonial->image)
                    <div class="mb-2">
                        <img src="{{ asset($testimonial->image) }}" alt="Current Image" style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Update Testimonial</button>
            <a href="{{ route('admin.testimonials') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@section('js')
    // Add any necessary JavaScript code here
@endsection
