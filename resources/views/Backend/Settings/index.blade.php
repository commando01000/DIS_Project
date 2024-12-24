@extends('Backend.Shared.layout')

@section('title', 'Settings')

@section('content')
    {{-- Top Part of HomePage Slider --}}
    <div class="themed-box">
        <h2>Top Part of HomePage The Slider</h2>
        <form action="{{ route('update.settings.slide') }}" method="POST">
            @csrf
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="title_en" class="form-label">Title (EN)</label>
                    <input type="text" class="form-control" placeholder="Title" name="title_en" id="title_en"
                        value="{{ Settings::getSettingValue('top-slider')['en']['title'] ?? '' }}" />
                   
             

                    @error('title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="title_ar" class="form-label">(AR) عنوان </label>
                    <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="عنوان"
                        dir="rtl" value="{{ Settings::getSettingValue('top-slider')['ar']['title'] ?? '' }}" />
                   

                    @error('title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">description (EN)</label>
                    <textarea class="form-control" placeholder="description for company" name="description_en" id="description_en">{{ Settings::getSettingValue('top-slider')['en']['description'] ?? '' }}</textarea> 
                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 text-end">
                    <label for="description_ar" class="form-label">(AR) وصف </label>
                    <textarea class="form-control" name="description_ar" id="description_ar" placeholder="وصف " dir="rtl">{{ Settings::getSettingValue('top-slider')['ar']['description'] ?? '' }}</textarea> 
                    @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @include('Backend.Shared.form-actions', ['settings' => $settings])
        </form>
    </div>

    <div class="themed-box">
        <h2>Polices</h2>
        <form action="{{ route('update.settings.polices') }}" method="POST">
            @csrf
            <!-- Section Translation Part -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="section_title_en" class="form-label">Section (EN)</label>
                    <input type="text" class="form-control" name="section_title_en" id="section_title_en"
                        value="{{ Settings::getSettingValue('policy')['en']['section_title_en'] ?? '' }}"
                        placeholder="Enter Section Name in English" />
                    @error('section_title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="section_title_ar" class="form-label">(AR) القسم</label>
                    <input type="text" class="form-control" name="section_title_ar" id="section_title_ar"
                        value="{{ Settings::getSettingValue('policy')['ar']['section_title_ar'] ?? '' }}" placeholder="أدخل اسم القسم"
                        dir="rtl" />
                    @error('section_title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!-- Title -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="title_en" class="form-label">Title (EN)</label>
                    <input type="text" class="form-control" name="title_en" id="title_en"
                        value="{{ Settings::getSettingValue('policy')['en']['name_en'] ?? '' }}" placeholder="Enter Title in English" />
                    @error('title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="title_ar" class="form-label">(AR) العنوان</label>
                    <input type="text" class="form-control" name="title_ar" id="title_ar"
                        value="{{ Settings::getSettingValue('policy')['ar']['name_ar'] ?? '' }}" placeholder="أدخل العنوان" dir="rtl" />
                    @error('title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @include('Backend.Shared.form-actions', ['settings' => $settings])
        </form>
    </div>
    <div class="themed-box">
        <h2>Side Button</h2>
        <form action="{{ route('update.settings.side-button') }}" method="POST">
            @csrf
            <input type="url" class="form-control" placeholder="url" name="url" id="url" 
                value="{{ Settings::getSettingValue('side-button')['url'] ?? '' }}" />
            <div class="form-actions d-flex justify-content-between align-items-center">
                {{-- if route is not clients --}}
                <input class="btn btn-success" name="translation" value="Save" type="submit" />
                <div class="toggle-container">
                </div>
            </div>
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

        });
    </script>
@endsection
