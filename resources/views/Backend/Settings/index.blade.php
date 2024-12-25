@extends('Backend.Shared.layout')

@section('title', 'Settings')

@section('content')
    {{-- Top Part of HomePage Slider --}}
    <div id ="top-slider" class="themed-box">
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
            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('top-slider'),
                'formName' => 'top-slider',
            ])
        </form>
    </div>

    <div id ="policy" class="themed-box">
        <h2>Polices</h2>
        <form action="{{ route('update.settings.polices') }}" method="POST">
            @csrf
            <!-- Section Translation Part -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="section_title_en" class="form-label">Section (EN)</label>
                    <input type="text" class="form-control" name="section_title_en" id="section_title_en"
                        value="{{ Settings::getSettingValue('policy')['en']['section_title'] ?? '' }}"
                        placeholder="Enter Section Name in English" />
                    @error('section_title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="section_title_ar" class="form-label">(AR) القسم</label>
                    <input type="text" class="form-control" name="section_title_ar" id="section_title_ar"
                        value="{{ Settings::getSettingValue('policy')['ar']['section_title'] ?? '' }}"
                        placeholder="أدخل اسم القسم" dir="rtl" />
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
                        value="{{ Settings::getSettingValue('policy')['en']['name'] ?? '' }}"
                        placeholder="Enter Title in English" />
                    @error('title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="title_ar" class="form-label">(AR) العنوان</label>
                    <input type="text" class="form-control" name="title_ar" id="title_ar"
                        value="{{ Settings::getSettingValue('policy')['ar']['name'] ?? '' }}" placeholder="أدخل العنوان"
                        dir="rtl" />
                    @error('title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('policy'),
                'formName' => 'policy',
            ])
        </form>
    </div>
    <div id="side-button" class="themed-box">
        <h2>Side Button</h2>
        <form action="{{ route('update.settings.side-button') }}" method="POST">
            @csrf
            <input type="url" class="form-control" placeholder="url" name="url" id="url"
                value="{{ Settings::getSettingValue('side-button')['url'] ?? '' }}" />
            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('side-button'),
                'formName' => 'side-button',
            ])
        </form>
    </div>
]
    <div id="footer" class="themed-box">
        {{-- Footer --}}
        {{-- @include('Backend.Footer.index') --}}
        @include('Backend.Footer.index')
        @yield('content')
    </div>
@endsection

@section('js')

@endsection
