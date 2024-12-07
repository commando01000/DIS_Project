@extends('Backend.Shared.layout')

@section('title', 'About')
@section('css')
    <style>
        /* Flex layout for form rows */
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            /* Space between EN and AR inputs */
            margin-bottom: 20px;
            /* Spacing between rows */
        }

        /* Each form group takes half width */
        .form-group {
            flex: 1;
            /* Ensure equal width for EN and AR fields */
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            /* Full width input */
        }

        .input-group-text {
            width: 100px;
        }

        /* Styling for form actions */
        /* Flex container for submit and toggle button */
        .form-actions {
            margin-top: 20px;
        }

        /* Default Light Mode Styles */
        [data-bs-theme="light"] #about-us-back {
            border: 2px solid var(--border-light);
            color: var(--text-light);
            background-color: transparent;
            box-shadow: 0 4px 6px var(--shadow-light);
            border-color: black;
            /* Black border in light mode */
        }



        /* Dark Mode Styles */
        [data-bs-theme="dark"] #about-us-back {
            border: 2px solid var(--border-dark);
            color: var(--text-dark);
            background-color: transparent;
            box-shadow: 0 4px 6px var(--shadow-dark);
            border-color: white;

            /* White border in dark mode */
        }

        /* Auto Mode (Optional) */
        [data-bs-theme="auto"] #about-us_back {
            border: 2px solid var(--border-light);
            /* Defaults to light mode initially */
            color: var(--text-light);
            box-shadow: 0 4px 6px var(--shadow-light);
        }
    </style>
@endsection

@section('content')
    <div id="about-us-back" class="m-5 p-5 w-75 mx-auto shadow rounded">
        <form action="{{ route('admin.about-us.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <!-- Section Title -->
            <div class="form-row">
                <div class="form-group">
                    <label for="section-title-en" class="form-label">Section Title EN</label>
                    <input type="text" class="form-control" name="section_title_en" id="section-title-en"
                        placeholder="Section Title en" value="{{ $settings['en']['section_title'] ?? '' }}" />
                </div>
                <div class="form-group">
                    <label for="section-title-ar" class="form-label">Section Title AR</label>
                    <input type="text" class="form-control" name="section_title_ar" id="section-title-ar"
                        placeholder="Section Title ar" value="{{ $settings['ar']['section_title'] ?? '' }}" />
                </div>
            </div>

            <!-- Title -->
            <div class="form-row">
                <div class="form-group">
                    <label for="title-en" class="form-label">Title EN</label>
                    <input type="text" class="form-control" name="title_en" id="title-en" placeholder="Title en"
                        value="{{ $settings['en']['title'] ?? '' }}" />
                </div>
                <div class="form-group">
                    <label for="title-ar" class="form-label">Title AR</label>
                    <input type="text" class="form-control" name="title_ar" id="title-ar" placeholder="Title ar"
                        value="{{ $settings['ar']['title'] ?? '' }}" />
                </div>
            </div>

            <!-- Description -->
            <div class="form-row">
                <div class="form-group">
                    <label for="description-en" class="form-label">Description EN</label>
                    <input type="text" class="form-control" name="description_en" id="description-en"
                        placeholder="Description en" value="{{ $settings['en']['description'] ?? '' }}" />
                </div>
                <div class="form-group">
                    <label for="description-ar" class="form-label">Description AR</label>
                    <input type="text" class="form-control" name="description_ar" id="description-ar"
                        placeholder="Description ar" value="{{ $settings['ar']['description'] ?? '' }}" />
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Title AR</label>
                <input type="text" class="form-control" name="title_ar" id="title-ar" placeholder="Title ar"
                    value="{{ $settings['ar']['title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description EN</label>
                <input type="text" class="form-control" name="description_en" id="description-en"
                    placeholder="Description en" value="{{ $settings['en']['description'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description AR</label>
                <input type="text" class="form-control" name="description_ar" id="description-ar"
                    placeholder="Description ar" value="{{ $settings['ar']['description'] ?? '' }}" />
            </div>
            @include('Backend.Shared.form-actions')
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const toggle = $('#toggle');
            const toggleStatus = $('#toggle-status');

            // When checkbox is toggled
            toggle.change(function() {
                const status = toggle.is(':checked') ? 'Show' : 'Hidden';
                toggleStatus.text(status === 'Show' ? 'Show' : 'Hidden'); // Update the status text

                // Send the new status via AJAX
                $.ajax({
                    url: '{{ route('update.form.status', ['form' => 'about', 'status']) }}', // Update with the actual route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        status: status, // Send the status (show/hidden)
                        form: 'about'
                    },
                    success: function(response) {
                        // apply success toaster
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('Error updating status', error);
                        window.location.reload();
                    }
                });
            });

            // Set initial status text based on checkbox state
            toggleStatus.text(toggle.is(':checked') ? 'Show' : 'Hidden');
        });
    </script>
@endsection
