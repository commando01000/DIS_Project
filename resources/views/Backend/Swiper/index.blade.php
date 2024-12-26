@extends('Backend.Shared.layout')

@section('title', 'Swiper')

@section('content')
    {{-- Top Part of HomePage Slider --}}
    <div id ="top-slider" class="themed-box">
        <h2>Top Part of HomePage The Slider</h2>
        <form action="{{ route('create.settings.swiper') }}" method="POST">
            @csrf
            @include('Backend.Shared.slider-top')
            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('top-slider'),
                'formName' => 'top-slider',
            ])
        </form>
    </div>
    <div class="modal fade" id="updateSwiperModal" tabindex="-1" aria-labelledby="updateSwiperModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateSwiperModalLabel">Swiper Data Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateSwiperForm" action="{{ route('update.settings.swiper') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Hidden Field for Index -->
                        <input type="hidden" id="swiper_index" name="index" value="">

                        <!-- Title English Field -->
                        <div class="mb-3">
                            <label for="title_en" class="form-label">Title (En)</label>
                            <input type="text" class="form-control" value="" id="title_en" name="title_en"
                                placeholder="Here English Title" required>
                        </div>

                        <!-- Description English Field -->
                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description (En)</label>
                            <input type="text" class="form-control" value="" id="description_en"
                                name="description_en" placeholder="Here English Description" required>
                        </div>

                        <!-- Title Arabic Field -->
                        <div class="mb-3">
                            <label for="title_ar" class="form-label">Title (AR)</label>
                            <input type="text" value="" class="form-control" id="title_ar" name="title_ar"
                                placeholder="Here Arabic Title" required>
                        </div>

                        <!-- Description Arabic Field -->
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">Description (AR)</label>
                            <input type="text" value="" class="form-control" id="description_ar"
                                name="description_ar" placeholder="Here Arabic Description" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="openEditModal(, )" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id='tableContainer' class="themed-box">
        <h2>Swiper Data</h2>
        {{-- Create Bank Button --}}
        <!-- Table displaying banks information -->
        <table id="swiperTable" class="table content table-bordered" style="display:none;">
            {{-- @php

            @endphp --}}
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Title English</th>
                    <th>Description English</th>
                    <th>Title Arabic</th>
                    <th>Description Arabic</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- Loop through each bank and display its details -->

                @foreach ($swipers as $swi => $value)
                    <tr>
                        <td>{{ $value['en']['title'] }}</td>
                        <td>{{ $value['en']['description'] }}</td>
                        <td>{{ $value['ar']['title'] }}</td>
                        <td>{{ $value['ar']['description'] }}</td>
                        <td>
                            <!-- Edit and delete actions for each bank -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#updateSwiperModal" onclick="openEditModal({{ $swi }})">
                                Edit
                            </button>
                            <form action="" method="POST" style="display:inline;">
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
        // Function to open the modal with specific index and populate fields
        // Update this function to pass the correct swiper data and index
        function openEditModal(index) {
            // Get the swiper data using the passed index
            const swiper = @json($swipers);

            // Populate the form with existing data based on the index
            document.getElementById('title_en').value = swiper[index].en.title;
            document.getElementById('description_en').value = swiper[index].en.description;
            document.getElementById('title_ar').value = swiper[index].ar.title;
            document.getElementById('description_ar').value = swiper[index].ar.description;

            // Set the index in the hidden input field to pass it to the controller
            document.getElementById('swiper_index').value = index;

            // Open the modal
            var myModal = new bootstrap.Modal(document.getElementById('updateSwiperModal'));
            myModal.show();
        }
    </script>
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <!-- JavaScript for Form Validation -->

    <script>
        $(document).ready(function() {
            $('.loader').show();
        });

        // Once the window is fully loaded, hide the loader and show the content
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
                const formName = $(this).data('form'); // Extract form name from the data attribute
                const toggleId = $(this).attr('id'); // Get the specific toggle ID
                const baseUrl =
                    "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
                const csrfToken = '{{ csrf_token() }}';
                // Call the initializeTable function
                initializeTable({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    formName: 'swipers'
                });
                initializer({
                    baseUrl: baseUrl.replace(':form', formName),
                    csrf_token: csrfToken,
                    formName: formName
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addInputTextContainer = document.getElementById('swiper-data-container');
            const addInputTextBtn = document.getElementById('swiper-data');

            // Function to create a new row for swiper data inputs
            function addInputTextRow() {
                const index = addInputTextContainer.children
                    .length; // Use direct count of rows for a simple integer index

                // Create a new row container
                const row = document.createElement('div');
                row.classList.add('d-flex', 'gap-2', 'mb-2');

                // Input: title_en (key)
                const titleKeyInput = document.createElement('input');
                titleKeyInput.type = 'text';
                titleKeyInput.name = `swiper-data[${index}][title_en]`;
                titleKeyInput.classList.add('form-control');
                titleKeyInput.placeholder = 'Enter title in English';

                // Input: description_en (value)
                const descriptionValueInput = document.createElement('input');
                descriptionValueInput.type = 'text';
                descriptionValueInput.name = `swiper-data[${index}][description_en]`;
                descriptionValueInput.classList.add('form-control');
                descriptionValueInput.placeholder = 'Enter description in English';

                // Input: title_ar (key)
                const titleKeyArInput = document.createElement('input');
                titleKeyArInput.type = 'text';
                titleKeyArInput.name = `swiper-data[${index}][title_ar]`;
                titleKeyArInput.classList.add('form-control');
                titleKeyArInput.placeholder = 'Enter title in Arabic';

                // Input: description_ar (value)
                const descriptionValueArInput = document.createElement('input');
                descriptionValueArInput.type = 'text';
                descriptionValueArInput.name = `swiper-data[${index}][description_ar]`;
                descriptionValueArInput.classList.add('form-control');
                descriptionValueArInput.placeholder = 'Enter description in Arabic';

                // Remove Button
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = 'Remove';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
                removeButton.addEventListener('click', function() {
                    row.remove();
                });

                // Append inputs and button to the row
                row.appendChild(titleKeyInput);
                row.appendChild(descriptionValueInput);
                row.appendChild(titleKeyArInput);
                row.appendChild(descriptionValueArInput);
                row.appendChild(removeButton);

                // Add the row to the container
                addInputTextContainer.appendChild(row);
            }

            // Attach the addInputTextRow function to the 'Add Slider' button
            addInputTextBtn.addEventListener('click', addInputTextRow);
        });
    </script>
@endsection
