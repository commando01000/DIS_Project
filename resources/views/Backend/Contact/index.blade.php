@extends('Backend.Shared.layout')

@section('title', 'Contacts')

@section('content')
    <div id="contacts-tables" class="themed-box">
        <h2>Contact Request</h2>
        <a href="{{ route('admin.contacts.settings') }}" class = "btn btn-success mb-3"> Go To Setting Section</a>
        <select name="filers[]" id="filers" class="form-control" multiple required>
            {{-- @foreach (Settings::getSettingValue('contacts')['filter-data'] as $filter_data)
                <option value="{{ $filter_data['en']['filter'] }}">{{ $filter_data['en']['filter'] }}</option>
            @endforeach --}}
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
        $(document).ready(function() {
            $('#filters').select2({
                placeholder: 'Filters',
                allowClear: true,
                width: '100%',
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
