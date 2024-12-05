@extends('Backend.Shared.layout')

@section('title', 'About')
@section('css')
    <style>
        .input-group-text {
            width: 100px;
        }

        /* Base styling for the container */
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between toggle and text */
            font-family: Arial, sans-serif;
        }

        /* Base styling for the toggle switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
        }

        /* Hide the checkbox */
        .toggle-input {
            display: none;
        }

        /* The toggle background */
        .toggle-label {
            display: block;
            width: 100%;
            height: 100%;
            background: #ccc;
            border-radius: 50px;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s ease;
        }

        /* The sliding indicator */
        .toggle-indicator {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        /* Change background when checked */
        .toggle-input:checked+.toggle-label {
            background: #4caf50;
            /* Green color for "Enabled" */
        }

        /* Slide the indicator when checked */
        .toggle-input:checked+.toggle-label .toggle-indicator {
            transform: translateX(30px);
        }

        /* Optional: Status text */
        .toggle-status {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            transition: color 0.3s ease;
        }

        /* Change text color dynamically for visual cue */
        .toggle-input:checked~.toggle-status {
            color: #4caf50;
        }

        /* Flex container for submit and toggle button */
        .form-actions {
            display: flex;
            justify-content: space-between;
            /* Push elements to opposite sides */
            align-items: center;
            /* Vertically align the elements */
            margin-top: 20px;
            /* Add spacing from the fields above */
        }

        /* Style adjustments for the toggle container */
        .toggle-container {
            margin-left: auto;
            /* Push toggle to the right */
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between the toggle and text */
        }
    </style>
@endsection


@section('content')
    <div id="about-us-back" class="m-5 p-5 w-75 mx-auto">
        <form action="{{ route('admin.about-us.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Section Title EN</label>
                <input type="text" class="form-control" name="section_title_en" id="section-title-en"
                    placeholder="Section Title en" value="{{ $translations['en']['section_title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Section Title AR</label>
                <input type="text" class="form-control" name="section_title_ar" id="section-title-ar"
                    placeholder="Section Title ar" value="{{ $translations['ar']['section_title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Title EN</label>
                <input type="text" class="form-control" name="title_en" id="title-en" placeholder="Title en"
                    value="{{ $translations['en']['title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Title AR</label>
                <input type="text" class="form-control" name="title_ar" id="title-ar" placeholder="Title ar"
                    value="{{ $translations['ar']['title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description EN</label>
                <input type="text" class="form-control" name="description_en" id="description-en"
                    placeholder="Description en" value="{{ $translations['en']['description'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description AR</label>
                <input type="text" class="form-control" name="description_ar" id="description-ar"
                    placeholder="Description ar" value="{{ $translations['ar']['description'] ?? '' }}" />
            </div>

            <div class="form-actions">
                <input class="btn btn-success" type="submit" />
                <div class="toggle-container">
                    <div class="toggle-switch">
                        <input type="checkbox" id="toggle" class="toggle-input" checked />
                        <!-- Set checked by default -->
                        <label for="toggle" class="toggle-label">
                            <span class="toggle-indicator"></span>
                        </label>
                    </div>
                    <span id="toggle-status" class="toggle-status">Show</span>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        // Get the checkbox and the status text element
        const toggle = document.getElementById('toggle');
        const toggleStatus = document.getElementById('toggle-status');

        // Add an event listener to update the status text dynamically
        toggle.addEventListener('change', () => {
            toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
        });

        // Set initial state for the status text
        toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
    </script>
@endsection
