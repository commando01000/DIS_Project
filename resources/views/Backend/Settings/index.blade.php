@extends('Backend.Shared.layout')

@section('title', 'Settings')

@section('content')
    <div id ="policy" class="themed-box">
        @include('Shared.loader')
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
            {{-- Policy Data --}}
            <hr>
            <h2>Policy Data </h2>
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">Description For Policy (EN)</label>
                    <textarea type="text" class="form-control" name="description_en" id="description_en"
                        placeholder="Description For Policy">
                        {{ Settings::getSettingValue('policy')['en']['section_title'] ?? '' }}
                    </textarea>

                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-start">
                    <label for="description_ar" class="form-label">وصف لي سياسة (AR)</label>
                    <textarea type="text" class="form-control" name="description_ar" id="description_ar" placeholder="  وصف لي سياسة ">
                        {{ Settings::getSettingValue('policy')['en']['section_title'] ?? '' }}
                    </textarea>

                    @error('description_ar')
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
    <div id="footer" class="themed-box">
        {{-- Footer --}}
        {{-- @include('Backend.Footer.index') --}}
        @include('Backend.Footer.index')
        @yield('content')
    </div>
    <div id="total-visits-count"class="text-light text-end pb-5">


        Total Visits Count : {{ Settings::getSettingValue('total_visits') ?? '0' }}
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
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
            const baseUrl = "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
            const csrfToken = '{{ csrf_token() }}';

            // Loop through all toggle inputs dynamically
            $('.toggle-input').each(function() {
                const formName = $(this).data('form'); // Extract foDhe data attribute
                const toggleId = $(this).attr('id'); // Get the specD

                // Initialize each toggle switch
                initializer({
                    baseUrl: baseUrl.replace(':form', formName),
                    csrf_token: csrfToken,
                    formName: formName
                });

                // Optional: Add a listener for toggle switch changes
                // $(this).change(function() {
                //     const status = $(this).is(':checked') ? 'on' : 'off';
                //     toggleStatus.text(status === "on" ? "Show" : "Hidden");
                //     const updateUrl = baseUrl.replace(':form', formName).replace(':status', status);

                //     // Make an AJAX request to update the status
                //     $.ajax({
                //         url: updateUrl,
                //         type: 'POST',
                //         headers: {
                //             'X-CSRF-TOKEN': csrfToken
                //         },
                //         success: function(response) {
                //             $(`#toggle-status-${formName}`).text(status === 'on' ?
                //                 'Show' : 'Hidden');
                //             console.log(`Status for ${formName} updated to ${status}`);
                //         },
                //         error: function(err) {
                //             console.error(`Failed to update status for ${formName}`,
                //                 err);
                //         }
                //     });
                // });
                console.log(`Toggle initialized for form: ${formName}`);
            });
        });
    </script>
@endsection
