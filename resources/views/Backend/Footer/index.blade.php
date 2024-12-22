@extends('Backend.Shared.layout')

@section('title', 'Footer')

@section('css')
    <style>
        #icon-display {
            font-size: 40px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')

    <div class="themed-box">
        <h2>Footer</h2>
        @php
            $footer = json_decode($settings[3]->value, true); // Convert JSON to an array
            // dd($footer);
        @endphp

        <form action="{{ route('admin.footer.store') }}" method="POST">
            @csrf
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="name_en" class="form-label">Company Name (EN)</label>
                    <input type="text" class="form-control" placeholder="Enter Company Name in English" name="name_en"
                        id="name_en" value="{{ $footer['en']['name_en'] ?? '' }}" />
                    @error('name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="name_ar" class="form-label">(AR) اسم الشركه </label>
                    <input type="text" class="form-control" name="name_ar" id="name_ar"
                        value="{{ $footer['ar']['name_ar'] ?? '' }}" placeholder="اسم الشركه العربيه" dir="rtl" />
                    @error('name_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">description (EN)</label>
                    <textarea class="form-control" placeholder="description for company" name="description_en" id="description_en">{{ $footer['en']['description_en'] ?? '' }}</textarea>
                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="description_ar" class="form-label">(AR) وصف لي الشركه</label>
                    <textarea class="form-control" name="description_ar" id="description_ar" placeholder="وصف لي الشركه" dir="rtl">{{ $footer['ar']['description_ar'] ?? '' }}</textarea>
                    @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Social Media Links -->
            @include('Backend.Shared.social-media', ['links' => $footer['links']])

            @include('Backend.Shared.form-actions')
        </form>
    </div>

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
                    formName: 'footer'
                });
                initializer({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    key: 'footer',
                    formName: 'footer'
                });
            });
        });
    </script>
@endsection
