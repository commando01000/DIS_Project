@extends('Backend.Shared.layout')

@section('title', 'Banks Data')

@section('content')
    <div class="container mt-5">
        @include('Shared.loader')
        <h2>Banks Data</h2>
        {{-- Create Bank Button --}}
        <a href="{{ route('admin.client.create') }}" class="btn btn-success mb-3">Create Bank</a>

        <!-- Table displaying banks information -->
        <table id="banksTable" class="table content table-bordered" style="display:none;">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Bank Name</th>
                    <th>Bank Image</th>
                    <th>Modules</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each bank and display its details -->
                @foreach ($banks as $bank)
                    <tr>
                        <!-- Checkbox for selection -->
                        <td>
                            <input type="checkbox" class="bank-checkbox" data-id="{{ $bank->id }}">
                        </td>
                        <!-- Display bank name -->
                        <td>{{ $bank->name[app()->getLocale()] }}</td>
                        <td>
                            <img class="dt-image" src="{{ asset($bank->image) }}" alt="{{ $bank->name[app()->getLocale()] }}"
                                class="img-fluid" />
                        </td>
                        <td>
                            <!-- Display the associated modules -->
                            @foreach ($bank->modules as $module)
                                <span>{{ $module->name }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <!-- Edit and delete actions for each bank -->
                            <a href="{{ route('admin.client.edit', $bank->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.client.destroy', $bank->id) }}" method="POST"
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
    <!-- Include DataTables JavaScript -->
    <script>
        $(document).ready(function() {
            $('.loader').show(); // Show the loader
            // Initialize DataTable
            const table = $('#banksTable').DataTable({
                scrollX: true,
                fixedColumns: true,
                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }, // For the checkbox column
                ],
                select: {
                    style: 'multi', // Allows multiple selection
                    selector: 'td:first-child input[type="checkbox"]'
                },
                order: [
                    [1, 'asc']
                ] // Default order by the second column (Bank Name)
            });

            // Once the window is fully loaded, hide the loader and show the content
            $(window).on('load', function() {
                // Show the loader when the page starts loading
                $('.loader').show();

                // Set a 3-second delay before hiding the loader and showing the content
                setTimeout(function() {
                    $('#loaderWrapper').hide();
                    $('.content').fadeIn(); // Show the main content
                }, 1500); // 1500 milliseconds = 3 seconds
            });

            // Checkbox selection handling
            $('#banksTable').on('click', 'input.bank-checkbox', function() {
                const row = $(this).closest('tr');
                if (this.checked) {
                    table.rows(row).select();
                } else {
                    table.rows(row).deselect();
                }
            });
        });
    </script>
@endsection
