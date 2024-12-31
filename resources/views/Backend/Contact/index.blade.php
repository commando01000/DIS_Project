@extends('Backend.Shared.layout')

@section('title', 'Contacts')

@section('content')
    <div id="contacts" class="themed-box">
        @include('Shared.loader')
        <h2>Contact Section Settings</h2>
        <form action="{{ route('update.settings.contacts') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', [
                    'settings' => Settings::getSettingValue('contacts'),
                ])
                <input type="text" name="phone_title" value="">
                <input type="text" name="email_title" value="">

                <hr>
                <h3>Contact Info</h3>
                <!-- Phone and mail -->
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                            value="{{ Settings::getSettingValue('contacts')['contact-info']['phone'] ?? '' }}"
                            placeholder="Enter company phone" />
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="mail" class="form-label">Mail</label>
                        <input type="text" class="form-control" name="mail" id="mail"
                            value="{{ Settings::getSettingValue('contacts')['contact-info']['mail'] ?? '' }}"
                            placeholder="mail" />
                        @error('mail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Address -->
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control" name="address" id="address"
                            value="{{ Settings::getSettingValue('contacts')['contact-info']['address'] ?? '' }}"
                            placeholder="Enter company address" />
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6 text-end">
                        <div class="footer-map" style="width: 100%; max-width: 600px; height: 300px;">
                            <iframe
                                src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY') }}&q={{$settings['contact-info']['address']}}"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div> --}}
                </div>
                <hr>

                <div class="mb-3">
                    <label for="filter-data" class="form-label">filter Data Section</label>
                    <div id="filter-data-container">
                        <!-- Dynamic filter-data inputs will be added here -->
                    </div>
                    <button type="button" class="btn btn-primary btn-sm mt-2" id="filter-data">Add
                        filter</button>
                </div>

                @include('Backend.Shared.form-actions', [
                    'settings' => Settings::getSettingValue('contacts'),
                    'formName' => 'contacts',
                ])
            </div>


        </form>

    </div>
    {{-- <div class="themed-box">
        <h2>Contact Info</h2>
        <form action="{{ route('update.settings.contacts') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-primary mt-3">Update Contact</button>
        </form>
    </div> --}}

    <div id="contacts-tables" class="themed-box">
        <h2>Contact Request</h2>
        <select name="filers[]" id="filers" class="form-control" multiple required>
            @foreach (Settings::getSettingValue('contacts')['filter-data'] as $filter_data)
                <option value="{{ $filter_data['en']['filter'] }}">{{ $filter_data['en']['filter'] }}</option>
            @endforeach
        </select>
        <table id="contactsTable" class="table content table-bordered">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Client Mail</th>
                    <th>Client Subject</th>
                    <th>Client Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each contact and display its details -->
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->mail }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>
                            <!-- Edit and delete actions for each module -->
                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-primary">Finish</a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        function filter() {
            document.addEventListener("DOMContentLoaded", function() {
                const addInputTextContainer = document.getElementById(
                    "filter-data-container"
                );
                const addInputTextBtn = document.getElementById("filter-data");

                // Log to check if the elements are correctly selected
                console.log(addInputTextContainer, addInputTextBtn);

                // Function to create a new row for filter data inputs
                function addInputTextRow() {
                    const index = addInputTextContainer.children
                        .length; // Use direct count of rows for a simple integer index

                    // Create a new row container
                    const row = document.createElement("div");
                    row.classList.add("d-flex", "gap-2", "mb-2");

                    // Input: title_en (key)
                    const filter_en = document.createElement("input");
                    filter_en.type = "text";
                    filter_en.name = `filter-data[${index}][filter_en]`;
                    filter_en.classList.add("form-control");
                    filter_en.placeholder = "Enter Filter (En)";

                    // Input: title_en (key)
                    const filter_ar = document.createElement("input");
                    filter_ar.type = "text";
                    filter_ar.name = `filter-data[${index}][filter_ar]`;
                    filter_ar.classList.add("form-control");
                    filter_ar.placeholder = "Enter Filter (Ar)";

                    // Remove Button
                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.textContent = "Remove";
                    removeButton.classList.add("btn", "btn-danger", "btn-sm");
                    removeButton.addEventListener("click", function() {
                        row.remove();
                    });

                    // Append inputs and button to the row
                    row.appendChild(filter_en);
                    row.appendChild(filter_ar);
                    row.appendChild(removeButton);

                    // Add the row to the container
                    addInputTextContainer.appendChild(row);
                }

                // Attach the addInputTextRow function to the 'Add filter' button
                if (addInputTextBtn) {
                    addInputTextBtn.addEventListener("click", addInputTextRow);
                } else {
                    console.error("Button not found!");
                }
            });
        }
        filter();
    </script>
    <script>
        $(document).ready(function() {
            $('#filers').select2({
                placeholder: 'Filers',
                allowClear: true,
                width: '100%',
                height: '50%'
            });
        });
    </script>
    <script>
        $(window).on('load', function() {
            // Show the loader when the page starts loading
            $('.loader').show();

            // Set a 1.5-second delay before hiding the loader and showing the content
            setTimeout(function() {
                $('#loaderWrapper').fadeOut(); // Ensure the loader wrapper fades out
                $('.content').fadeIn(); // Ensure the main content fades in
            }, 1500); // 1500 milliseconds = 1.5 seconds

        });



        $(document).ready(function() {


            let baseUrl =
                "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
            token = '{{ csrf_token() }}';

            // Initialize the table
            $('#contactsTable').DataTable();
            initializeTable({
                contacts: 'contacts'
            });

            // Initialize other components
            initializer({
                baseUrl: baseUrl,
                csrf_token: token,
                key: 'contacts',
                formName: 'contacts'
            });
        });
    </script>

@endsection
