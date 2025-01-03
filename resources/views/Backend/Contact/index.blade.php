@extends('Backend.Shared.layout')

@section('title', 'Contacts')

@section('content')
    <div id="contacts-tables" class="themed-box">
        <h2>Contact Request</h2>

        <a href="{{ route('admin.contacts.settings') }}" class = "btn btn-success mb-3"> Go To Setting Section</a>
        <select id="filters" class="form-control" multiple>
            @foreach (Settings::getSettingValue('contacts_filters')['filter-data'] as $filter_data)
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
                    <th>phone</th>
                    <th>nationality</th>
                    <th>Category</th>
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
                        <td>{{ $contact->nationality }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->category }}</td>
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
    <script>
        $(document).ready(function() {
            // Initialize DataTable without server-side processing
            var table = $('#contactsTable').DataTable();

            // Handle dropdown change event
            $('#filters').on('change', function() {
                var selectedFilters = $('#filters').val(); // Get selected filters as an array

                // Clear the table search (ensure no previous search is active)
                table.search('');

                // If filters are selected, apply filtering to the table
                if (selectedFilters && selectedFilters.length > 0) {
                    // Loop through all rows and check if they match any of the selected filters
                    table.rows().every(function() {
                        var row = this.node();
                        var rowData = table.row(row).data();

                        // Check if any of the selected filters match the data in the row
                        var matchesFilter = selectedFilters.some(function(filter) {
                            return rowData.some(function(cell) {
                                return cell.toString().toLowerCase().includes(filter
                                    .toLowerCase());
                            });
                        });

                        // Show or hide row based on whether it matches the filter
                        if (matchesFilter) {
                            $(row).show(); // Show the row if it matches the filter
                        } else {
                            $(row).hide(); // Hide the row if it doesn't match the filter
                        }
                    });
                } else {
                    // If no filters are selected, show all rows (reset to full table)
                    table.rows().show();
                }
            });
        });
    </script>




    {{-- <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                serverSide: true,
                ajax: {
                    url: '/path-to-your-server-script',
                    data: function(d) {
                        d.filter = $('#filter-buttons .active').data('filter'); // Pass filter parameter
                    }
                }
            });

            // Handle button clicks
            $('.filter-buttons button').on('click', function() {
                $('.filter-buttons button').removeClass('active');
                $(this).addClass('active');
                table.ajax.reload(); // Reload data with the selected filter
            });
        });

        $(document).ready(function() {
            var table = $('#contactsTable').DataTable();

            // Button Click Handlers
            $('#filter-support').on('click', function() {
                table.search('support').draw(); // Filter rows with "Support"
            });

            $('#filter-problem').on('click', function() {
                table.search('problem').draw(); // Filter rows with "Problem"
            });

            $('#filter-other').on('click', function() {
                table.search('other').draw(); // Filter rows with "Other"
            });

            $('#filter-all').on('click', function() {
                table.search('').draw(); // Clear the filter
            });
        });
    </script> --}}

@endsection
