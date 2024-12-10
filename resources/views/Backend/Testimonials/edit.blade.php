@extends('Backend.Shared.layout')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="container mt-5">
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

            <!-- Address -->
            <div class="mb-3">
                <label for="address_en" class="form-label">Address (English)</label>
                <textarea class="form-control" id="address_en" name="address[en]" rows="4" required>{{ old('address.en', $testimonial->address['en']) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="address_ar" class="form-label">Address (Arabic)</label>
                <textarea class="form-control" id="address_ar" name="address[ar]" rows="4" required>{{ old('address.ar', $testimonial->address['ar']) }}</textarea>
            </div>

            <!-- Social Media Links -->
            <div class="mb-3">
                <label for="social_media" class="form-label">Social Media Links</label>
                <div id="social-media-container">
                    @if ($testimonial->social_media)
                        @foreach ($testimonial->social_media as $key => $value)
                            <div class="d-flex gap-2 mb-2">
                                <input type="text" name="social_media[{{ $loop->index }}][key]" class="form-control"
                                    placeholder="Enter social media name (e.g., Facebook)" value="{{ $key }}">
                                <input type="url" name="social_media[{{ $loop->index }}][value]" class="form-control"
                                    placeholder="Enter social media link" value="{{ $value }}">
                                <button type="button" class="btn btn-danger btn-sm remove-social-media">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="add-social-media">Add Social Media</button>
            </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const socialMediaContainer = document.getElementById('social-media-container');
            const addSocialMediaBtn = document.getElementById('add-social-media');

            // Add new social media input fields
            addSocialMediaBtn.addEventListener('click', function() {
                const index = socialMediaContainer.children.length;

                // Create a new row for social media key-value input
                const row = document.createElement('div');
                row.classList.add('d-flex', 'gap-2', 'mb-2');

                // Social Media Key Input
                const keyInput = document.createElement('input');
                keyInput.type = 'text';
                keyInput.name = `social_media[${index}][key]`;
                keyInput.classList.add('form-control');
                keyInput.placeholder = 'Enter social media name (e.g., Facebook)';

                // Social Media Value Input
                const valueInput = document.createElement('input');
                valueInput.type = 'url';
                valueInput.name = `social_media[${index}][value]`;
                valueInput.classList.add('form-control');
                valueInput.placeholder = 'Enter social media link';

                // Remove Button
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = 'Remove';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
                removeButton.addEventListener('click', function() {
                    row.remove(); // Remove this row
                });

                // Append inputs and button to the row
                row.appendChild(keyInput);
                row.appendChild(valueInput);
                row.appendChild(removeButton);

                // Add the row to the container
                socialMediaContainer.appendChild(row);
            });

            // Remove social media inputs
            socialMediaContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-social-media')) {
                    event.target.closest('.d-flex').remove();
                }
            });
        });
    </script>
@endsection
