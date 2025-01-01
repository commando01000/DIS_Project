@extends('Backend.Shared.layout')

@section('title', 'Swiper')

@section('content')
    {{-- Top Part of HomePage Swiper --}}
    <div id ="swiper" class="themed-box">
        @include('Shared.loader')
        <h2>Swiper</h2>
        <form action="{{ route('settings.swiper.create') }}" method="POST">
            @csrf
            @include('Backend.Shared.swiper')
            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('swiper'),
                'formName' => 'swiper',
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
                @php
                    $swipers = Settings::getSettingValue('swiper')['swiper-data'];

                @endphp
                <form id="updateSwiperForm" action="{{ route('settings.swiper.update') }}" method="POST"
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
        <table id="swiperTable" class="table content table-bordered">
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
                    {{-- {{ dd($value) }} --}}
                    <tr>
                        <td>{{ $value['en']['title'] ?? 'N/A' }}</td>
                        <td>{{ $value['en']['description'] ?? 'N/A' }}</td>
                        <td>{{ $value['ar']['title'] ?? 'N/A' }}</td>
                        <td>{{ $value['ar']['description'] ?? 'N/A' }}</td>
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
@section('scripts')
    <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>

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
    </script>
    <script>
        $(document).ready(function() {
            $('#swiperTable').DataTable();
            initializeTable({
                formName: 'swiperTable'
            });

            initializer({
                baseUrl: baseUrl,
                csrf_token: token,
                key: 'swiper',
                formName: 'swiper'
            });
        });
    </script>
@endsection
