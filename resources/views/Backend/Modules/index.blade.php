@extends('Backend.Shared.layout')

@section('title', 'Modules Data')

@section('content')
    <div class="container mt-5">
        <h2>Modules Data</h2>
        {{-- Create Module Button --}}
        <a href="{{ route('admin.modules.create') }}" class="btn btn-success mb-3">Create Module</a>

        <!-- Table displaying modules information -->
        <table id="modulesTable" class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Module Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each module and display its details -->
                @foreach ($modules as $module)
                    <tr>
                        <!-- Checkbox for selection -->
                        {{-- <td>
                            <input type="checkbox" class="module-checkbox" data-id="{{ $module->id }}">
                        </td> --}}
                        <!-- Display module name -->
                        <td>{{ $module->name }}</td>
                        <td>
                            <!-- Edit and delete actions for each module -->
                            <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST"
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
            // Initialize DataTable
            const table = $('#modulesTable').DataTable({
                scrollX: true,
                fixedColumns: true,
                // columnDefs: [{
                //         orderable: false,
                //         className: 'select-checkbox',
                //         targets: 0
                //     }, // For the checkbox column
                // ],
                // select: {
                //     style: 'multi', // Allows multiple selection
                //     selector: 'td:first-child input[type="checkbox"]'
                // },
                order: [
                    [1, 'asc']
                ] // Default order by the second column (Module Name)
            });

            // Checkbox selection handling
            $('#modulesTable').on('click', 'input.module-checkbox', function() {
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
