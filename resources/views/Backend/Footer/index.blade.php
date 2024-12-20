@extends('Backend.Shared.layout')

@section('title', 'Footer')

@section('css')
    <style>
        #icon-display {
            font-size: 40px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')

    <div class="themed-box">
        <h2>Footer</h2>
        @php
            $footer = json_decode($settings[3]->value, true); // Convert JSON to an array
            // dd($footer);
        @endphp

        <form action="{{ route('admin.footer.store') }}" method="POST">
            @csrf
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="name_en" class="form-label">Company Name (EN)</label>
                    <input type="text" class="form-control" placeholder="Enter Company Name in English" name="name_en"
                        id="name_en" value="{{ $footer['en']['name_en'] ?? '' }}" />
                    @error('name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="name_ar" class="form-label">(AR) اسم الشركه </label>
                    <input type="text" class="form-control" name="name_ar" id="name_ar"
                        value="{{ $footer['ar']['name_ar'] ?? '' }}" placeholder="اسم الشركه العربيه" dir="rtl" />
                    @error('name_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">description (EN)</label>
                    <textarea class="form-control" placeholder="description for company" name="description_en" id="description_en">{{ $footer['en']['description_en'] ?? '' }}</textarea>
                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="description_ar" class="form-label">(AR) وصف لي الشركه</label>
                    <textarea class="form-control" name="description_ar" id="description_ar" placeholder="وصف لي الشركه" dir="rtl">{{ $footer['ar']['description_ar'] ?? '' }}</textarea>
                    @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="mb-3">
                <label for="social_media" class="form-label">Social Media Links Section</label>
                <div id="social-media-container">
                    <!-- Social Media Inputs will be added dynamically here -->
                    @if (!empty($footer['links']))
                        @foreach (json_decode($footer['links'], true) as $index => $link)
                            <div class="d-flex gap-2 mb-2">
                                <input type="text" name="social_media[{{ $index }}][key]" class="form-control"
                                    value="{{ $link['key'] ?? '' }}"
                                    placeholder="Enter label (e.g., Facebook, Phone, Email)">
                                <input type="text" name="social_media[{{ $index }}][value]" class="form-control"
                                    value="{{ $link['value'] ?? '' }}"
                                    placeholder="Enter the URL or contact (e.g., https://facebook.com/yourpage)">
                                <button type="button" class="btn btn-danger btn-sm">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="add-social-media">Add Social Media</button>
            </div>

            @include('Backend.Shared.form-actions')
        </form>
    </div>

    </div>


@endsection

@section('js')
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <!-- JavaScript for Form Validation -->

    <script>
        $(document).ready(function() {
            $('.loader').show();
        });

        // Once the window is fully loaded, hide the loader and show the content
        $(window).on('load', function() {
            // Show the loader when the page starts loading
            $('.loader').show();

            // Set a 1.5-second delay before hiding the loader and showing the content
            setTimeout(function() {
                $('#loaderWrapper').hide();
                $('.content').fadeIn(); // Show the main content
            }, 1500); // 1500 milliseconds = 1.5 seconds

            // Call the initializer toggle function
            $(document).ready(function() {
                let baseUrl =
                    "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
                token = '{{ csrf_token() }}';
                // Call the initializeTable function
                initializeTable({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    formName: 'footer'
                });
                initializer({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    key: 'footer',
                    formName: 'footer'
                });
            });
        });
    </script>

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
                keyInput.placeholder = 'Enter label (e.g., Facebook, Phone, Email)';

                // Social Media Value Input
                const valueInput = document.createElement('input');
                valueInput.type = 'text';
                valueInput.name = `social_media[${index}][value]`;
                valueInput.classList.add('form-control');
                valueInput.placeholder = 'Enter the URL or contact (e.g., https://facebook.com/yourpage)';

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
        });
    </script>
@endsection
