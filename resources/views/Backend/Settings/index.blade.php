@extends('Backend.Shared.layout')

@section('title', 'Settings')

@section('content')
    {{-- Top Part of HomePage Slider --}}
    <div class="themed-box">
        <h2>Top Part of HomePage The Slider</h2>
        <form action="{{route('admin.settings.slide')}}" method="POST">
            @csrf
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="title_en" class="form-label">Title (EN)</label>
                    <input type="text" class="form-control" placeholder="Title" name="title_en" id="title_en"
                        value="{{ $settings['en']['title_en'] ?? '' }}" />

                    @error('title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="title_ar" class="form-label">(AR) عنوان </label>
                    <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="عنوان"
                        dir="rtl" value="{{ $settings['ar']['title_ar'] ?? '' }}" />

                    @error('title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">description (EN)</label>
                    <textarea class="form-control" placeholder="description for company" name="description_en" id="description_en">{{ $settings['en']['description_en'] ?? '' }}</textarea>
                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="description_ar" class="form-label">(AR) وصف </label>
                    <textarea class="form-control" name="description_ar" id="description_ar" placeholder="وصف " dir="rtl">{{ $settings['ar']['description_ar'] ?? '' }}</textarea>
                    @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @include('Backend.Shared.form-actions', ['settings' => $settings])
        </form>
    </div>
@endsection


@section('js')
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
                let baseUrl =
                    "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
                token = '{{ csrf_token() }}';
                // Call the initializeTable function
                initializeTable({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    formName: 'top-slider'
                });
                initializer({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    key: 'top-slider',
                    formName: 'top-slider'
                });
            });
        });
    </script>
@endsection
