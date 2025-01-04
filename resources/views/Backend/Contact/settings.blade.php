@extends('Backend.Shared.layout')

@section('title', 'Contacts')

@section('content')

    <div id="contacts" class="themed-box">
        {{-- @include('Shared.loader') --}}
        <h2>Contact Section Settings</h2>
        @php
            $settings = Settings::getSettingValue('contacts');
        @endphp
        <form action="{{ route('update.settings.contacts') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', [
                    'settings' => Settings::getSettingValue('contacts'),
                ])
                {{-- Nationality --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="nationality_title_en" class="form-label">Nationality Title (English)</label>
                        <input type="text" class="form-control" name="nationality_title_en" id="nationality_title_en"
                            value="{{ $settings['en']['nationality_title'] ?? '' }}"
                            placeholder="Nationality Title (English)" />
                        @error('nationality_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="nationality_title_ar" class="form-label">Nationality Title (Arabic)</label>
                        <input type="text" class="form-control" name="nationality_title_ar" id="nationality_title_ar"
                            value="{{ $settings['ar']['nationality_title'] ?? '' }}" placeholder="عنوان الجنسية (Arabic)" />
                        @error('nationality_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Category --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="category_title_en" class="form-label">Category Title (English)</label>
                        <input type="text" class="form-control" name="category_title_en" id="category_title_en"
                            value="{{ $settings['en']['category_title'] ?? '' }}" placeholder="Category Title (English)" />
                        @error('category_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="category_title_ar" class="form-label">Category Title (Arabic)</label>
                        <input type="text" class="form-control" name="category_title_ar" id="category_title_ar"
                            value="{{ $settings['ar']['category_title'] ?? '' }}" placeholder="عنوان الفئة (Arabic)" />
                        @error('category_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Our Phone  --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="our_phone_title_en" class="form-label">Our Phone Title (English)</label>
                        <input type="text" class="form-control" name="our_phone_title_en" id="our_phone_title_en"
                            value="{{ $settings['en']['our_phone_title'] ?? '' }}"
                            placeholder="Our Phone Title (English)" />
                        @error('our_phone_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="our_phone_title_ar" class="form-label">Our Phone Title (Arabic)</label>
                        <input type="text" class="form-control" name="our_phone_title_ar" id="our_phone_title_ar"
                            value="{{ $settings['ar']['our_phone_title'] ?? '' }}" placeholder="عنوان هاتفنا (Arabic)" />
                        @error('our_phone_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Client Phone --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="client_phone_title_en" class="form-label">Client Phone Title (English)</label>
                        <input type="text" class="form-control" name="client_phone_title_en" id="client_phone_title_en"
                            value="{{ $settings['en']['client_phone_title'] ?? '' }}"
                            placeholder="Client Phone Title (English)" />
                        @error('client_phone_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="client_phone_title_ar" class="form-label">Client Phone Title (Arabic)</label>
                        <input type="text" class="form-control" name="client_phone_title_ar" id="client_phone_title_ar"
                            value="{{ $settings['ar']['client_phone_title'] ?? '' }}"
                            placeholder="عنوان هاتف العميل (Arabic)" />
                        @error('client_phone_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Email --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="email_title_en" class="form-label">Email Title (English)</label>
                        <input type="text" class="form-control" name="email_title_en" id="email_title_en" value="{{ $settings['en']['email_title'] ?? '' }}"
                            placeholder="Email Title arabic" />
                        @error('email_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="email_title_ar" class="form-label">Client Phone Title (Arabic)</label>
                        <input type="text" class="form-control" name="email_title_ar" id="email_title_ar"
                            value="{{ $settings['ar']['email_title'] ?? '' }}" placeholder="الايميل (Arabic)" />
                        @error('email_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- address --}}
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="address_title" class="form-label">Address Title (English)</label>
                        <input type="text" class="form-control" name="address_title_en" id="address_title_en" value="{{ $settings['en']['address_title'] ?? '' }}"
                            placeholder="Address Title (English)" />
                        @error('address_title_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="address_title_ar" class="form-label">عنوان العنوان (Arabic)</label>
                        <input type="text" class="form-control" name="address_title_ar" id="address_title_ar"
                            value="{{ $settings['ar']['address_title'] ?? '' }}" placeholder=" عنوان العنوان (Arabic)" />
                        @error('address_title_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr>
                <h3>Contact Info</h3>

                <!-- Phone and mail -->
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                            value="{{ $settings['contact-info']['phone'] ?? '' }}" placeholder="Enter company phone" />
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 text-start">
                        <label for="mail" class="form-label">Mail</label>
                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ $settings['contact-info']['email'] ?? '' }}" placeholder="Email" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-4 row align-items-center">
                    <div class="col-md-6 text-start">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control" name="address" id="address"
                            value="{{ $settings['contact-info']['address'] ?? '' }}"
                            placeholder="Enter company address" />
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6 text-end">
                        <div class="footer-map" style="width: 100%; max-width: 600px; height: 300px;">
                            <iframe
                                src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY') }}&q={{$settings['contact-info']['address']}}"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div> --}}
                </div>
                <hr>



                @include('Backend.Shared.form-actions', [
                    'settings' => Settings::getSettingValue('contacts'),
                    'formName' => 'contacts',
                ])
            </div>


        </form>

    </div>
@endsection
