@extends('Backend.Shared.layout')

@section('title', 'Testimonials')

@section('content')
    <div id="testimonials" class="themed-box">
        <h2>Testimonials</h2>
        {{-- Create Testimonial Button --}}
        <form action="{{ route('update.settings.testimonials') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', ['settings' => Settings::getSettingValue('testimonials')])

                @include('Backend.Shared.form-actions', ['settings' => Settings::getSettingValue('testimonials'), 'formName' => 'testimonials'])
            </div>
        </form>
    </div>

    <div id="testimonials-table" class="themed-box">
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-success mb-3">Create Testimonial</a>

        <!-- Table displaying Testimonials information -->
        <table id="testimonialsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Social Media</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each testimonial and display its details -->
                @foreach ($testimonials as $testimonial)
                    <tr>
                        <!-- Display name -->
                        <td>{{ $testimonial->name['en'] }}</td>

                        <!-- Display role -->
                        <td>{{ $testimonial->role['en'] }}</td>

                        <!-- Display description -->
                        <td>{{ $testimonial->description['en'] }}</td>

                        <td>
                            @if (!empty($testimonial->social_media))
                                @foreach ($testimonial->social_media as $platform => $link)
                                    <a href="{{ $link }}" target="_blank" class="d-block">
                                        {{ ucfirst($platform) }}
                                    </a>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>

                        <!-- Display image -->
                        <td>
                            <img class="dt-image" src="{{ asset($testimonial->image) }}"
                                alt="{{ $testimonial->name['en'] }}" class="img-fluid" style="max-width: 100px;">
                        </td>

                        <!-- Actions: Edit and Delete -->
                        <td>
                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- @include('Backend.Shared.form-visibility') --}}
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
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
                let baseUrl =
                    "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
                token = '{{ csrf_token() }}';
                // Call the initializeTable function
                initializeTable({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    formName: 'testimonials'
                });
                initializer({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    key: 'testimonials',
                    formName: 'testimonials'
                });
            });
        });
    </script>
@endsection
