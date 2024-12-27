<style>
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
</style>

<div class="form-actions d-flex justify-content-between align-items-center">
    <input class="btn btn-success" name="translation" value="Save Translation" type="submit" />
    <div class="toggle-switch">
        <input type="checkbox" name="status_{{ $formName }}" id="toggle_{{ $formName }}" class="toggle-input"
            data-form="{{ $formName }}" {{ $settings['status'] === 'on' ? 'checked' : '' }} />
        <label for="toggle_{{ $formName }}" class="toggle-label">
            <span class="toggle-indicator"></span>
        </label>
        <span id="toggle-status-{{ $formName }}" class="toggle-status text-light">
            {{ $settings['status'] === 'on' ? 'Show' : 'Hidden' }}
        </span>
    </div>
</div>
@section('js')
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <script>
        $(document).ready(function() {
            const baseUrl = "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
            const csrfToken = '{{ csrf_token() }}';

            // Loop through all toggle inputs dynamically
            $('.toggle-input').each(function() {
                const formName = $(this).data('form'); // Extract foDhe data attribute
                const toggleId = $(this).attr('id'); // Get the specD

                // Initialize each toggle switch
                initializer({
                    baseUrl: baseUrl.replace(':form', formName),
                    csrf_token: csrfToken,
                    formName: formName
                });

                // Optional: Add a listener for toggle switch changes
                $(this).change(function() {
                    const status = $(this).is(':checked') ? 'on' : 'off';
                    toggleStatus.text(status === "on" ? "Show" : "Hidden");
                    const updateUrl = baseUrl.replace(':form', formName).replace(':status', status);

                    // Make an AJAX request to update the status
                    $.ajax({
                        url: updateUrl,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $(`#toggle-status-${formName}`).text(status === 'on' ?
                                'Show' : 'Hidden');
                            console.log(`Status for ${formName} updated to ${status}`);
                        },
                        error: function(err) {
                            console.error(`Failed to update status for ${formName}`,
                                err);
                        }
                    });
                });
                console.log(`Toggle initialized for form: ${formName}`);
            });

        });
    </script>
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <script>
        $(document).ready(function() {
            const baseUrl =
                "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
            const csrfToken = '{{ csrf_token() }}';

            initializer({
                baseUrl: baseUrl,
                csrf_token: csrfToken,
                formName: '{{ $formName }}' 
            });
        });
    </script> --}}
@endsection
