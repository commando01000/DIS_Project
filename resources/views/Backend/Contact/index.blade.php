@extends('Backend.Shared.layout')

@section('title', 'Contact')

@section('content')
    <div id="contacts" class="themed-box">
        @include('Shared.loader')
        <h2>Contact</h2>
        <form action="{{ route('update.settings.contacts') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', ['settings' => $settings])

                @include('Backend.Shared.form-actions')
            </div>
        </form>
    </div>

    <div id="contact-table" class="themed-box">
        <h2>Contact Request</h2>
        <!-- Table displaying banks information -->
        <table id="banksTable" class="table content table-bordered" style="display:none;">
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
                            <button type="submit" class="btn btn-success">Finsish</button>
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
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <!-- JavaScript for Form Validation -->

    <script>
        // Once the window is fully loaded, hide the loader and show the content
        $(window).on('load', function() {
            // Show the loader when the page starts loading
            $('.loader').show();

            // Set a 1.5-second delay before hiding the loader and showing the content
            setTimeout(function() {
                $('#loaderWrapper').hide();
                $('.content').fadeIn(); // Show the main content
            }, 1500); // 1500 milliseconds = 1.5 seconds
        });

        // Call the initializer toggle function
        $(document).ready(function() {
            let baseUrl =
                "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";


            token = '{{ csrf_token() }}';
            // Call the initializeTable function
            initializeTable({
                baseUrl: baseUrl,
                csrf_token: token,
                formName: 'contacts'
            });
            initializer({
                baseUrl: baseUrl,
                csrf_token: token,
                key: 'contacts',
                formName: 'contacts'
            });
        });
    </script>
@endsection
