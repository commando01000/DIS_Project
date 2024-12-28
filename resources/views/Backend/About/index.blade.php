@extends('Backend.Shared.layout')

@section('title', 'About')

@section('content')
    <div id="about-back" class="themed-box">

        @include('Shared.loader')
        <!-- Displaying validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.about-us.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <!-- Section Title -->
            <div class="form-row">
                <div class="form-group">
                    <label for="section-title-en" class="form-label">Section Title EN</label>
                    <input type="text" class="form-control @error('section_title_en') is-invalid @enderror"
                        name="section_title_en" id="section-title-en" placeholder="Section Title en"
                        value="{{ Settings::getSettingValue('about')['en']['section_title'] ?? '' }}" />
                    @error('section_title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="section-title-ar" class="form-label">Section Title AR</label>
                    <input type="text" class="form-control @error('section_title_ar') is-invalid @enderror"
                        name="section_title_ar" id="section-title-ar" placeholder="Section Title ar"
                        value="{{ Settings::getSettingValue('about')['ar']['section_title'] ?? '' }}" />
                    @error('section_title_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Title -->
            <div class="form-row">
                <div class="form-group">
                    <label for="title-en" class="form-label">Title EN</label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en"
                        id="title-en" placeholder="Title en"
                        value="{{ Settings::getSettingValue('about')['en']['title'] ?? '' }}" />
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title-ar" class="form-label">Title AR</label>
                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar"
                        id="title-ar" placeholder="Title ar"
                        value="{{ Settings::getSettingValue('about')['ar']['title'] ?? '' }}" />
                    @error('title_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-row">
                <div class="form-group">
                    <label for="description-en" class="form-label">Description EN</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" name="description_en" id="description-en"
                        placeholder="Description en">{{ Settings::getSettingValue('about')['en']['description'] ?? '' }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description-ar" class="form-label">Description AR</label>
                    <textarea class="form-control @error('description_ar') is-invalid @enderror" name="description_ar" id="description-ar"
                        placeholder="Description ar">{{ Settings::getSettingValue('about')['ar']['description'] ?? '' }}</textarea>
                    @error('description_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('about'),
                'formName' => 'about',
            ])
        </form>
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
    <!-- JavaScript for Form Validation -->
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
        // Call the initializer toggle function
        $(document).ready(function() {
        let baseUrl =
            "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
        token = '{{ csrf_token() }}';

        initializer({
            baseUrl: baseUrl,
            csrf_token: token,
            key: 'about',
            formName: 'about'
        });
        });
        });
    </script>
@endsection
