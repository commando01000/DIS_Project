@extends('Backend.Shared.layout')

@section('title', 'Contacts')

@section('content')
    <div id="contacts" class="themed-box">
        @include('Shared.loader')
        <h2>Contact</h2>
        <form action="{{ route('update.settings.contacts') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', [
                    'settings' => Settings::getSettingValue('contacts'),
                ])
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
                <br>
                <!-- Title -->
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

    <div id="contact-table" class="themed-box">
        <h2>Contact Request</h2>
        <!-- Table displaying banks information -->
        <table id="contactsTable" class="table content table-bordered">
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Client Name</th>
                    <th>Client Mail</th>
                    <th>client Subject</th>
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

@section('js')

    <script>
        // Call the initializer toggle function
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
                    formName: 'contactsTable'
                });
                initializer({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    key: 'contacts',
                    formName: 'contacts'
                });
            });
        });
    </script>
@endsection
