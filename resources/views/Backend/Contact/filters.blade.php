@extends('Backend.Shared.layout')

@section('title', 'Contact')

@section('content')
    <div class="themed-box">
        <h2>Filters</h2>
        @php
            $filter_data = Settings::getSettingValue('contacts_filters')['filter-data'] ?? [];
        @endphp
        <div class="mb-3">
            <form action="{{ route('admin.contacts.filters.update') }}" class="post">
                @csrf
                <label for="filter-data" class="form-label">filter Data Section</label>
                <div id="filter-data-container">
                    <!-- Dynamic filter-data inputs will be added here -->
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="filter-data">Add
                    filter</button>
                <div class="form-actions d-flex justify-content-between align-items-center">
                    <input class="btn btn-success" name="translation" value="Save" type="submit" />
                </div>
                {{-- @include('Backend.Shared.form-actions', [
                    'settings' => Settings::getSettingValue('contacts'),
                    'formName' => 'contacts_filters',
                ]) --}}
            </form>
        </div>
    </div>

    <div id="projects-tables" class="themed-box">
        <h2>Contact Filter</h2>
        <!-- Table displaying Projects information -->
        <table id="contact-filterTable" class="table content table-bordered">
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Title English</th>
                    <th>Title Arabic</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd(app()->getLocale());}} --}}
                <!-- Loop through each project and display its details -->
                {{-- {{dd($projects);}} --}}
                @foreach ($filter_data as $filter)
                    <tr>

                        {{-- {{dd($filter);}} --}}
                        <td>{{ $filter['en']['filter'] ?? "Can't Load Data" }}</td>
                        <td>{{ $filter['ar']['filter'] ?? "Can't Load Data"}}</td>
                        <td>
                            <!-- Edit and delete actions for each project -->
                            <a href="" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.contacts.filters.destroy', $loop->index) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            {{-- <form action="{{ route('admin.contacts.filters.destroy', $filter['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
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
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#contact-filterTable').DataTable();
            initializeTable({
                formName: 'contact-filterTable'
            });
        });
    </script>
@endsection()
