<style>
    input {
        input {
            height: 30px;
            width: 90%;
        }
    }

    select {

        select {
            height: 40px;
            width: 90%;
            font-size: 13px;
            justify-content: center;
            align-content: center;
        }
    }
</style>

<div id ="contact"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('contacts')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-phone">{{ translate('contacts')['section_title'] ?? 'Contact us' }}</h2>
    <h1>{{ translate('contacts')['title'] ?? 'contact' }} </h1>

    <div class="contact-container">

        <fieldset class="contact-fieldset w-100 my-3 p-3 rounded-3">

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center align-items-center w-100 m-auto">
                    <div class="col-md-6">
                        <!-- Phone and other details -->
                        <div class="action-btn fa fa-phone">
                            
                            <p>{{ Settings::getSettingValue('contacts')['contact-info']['phone'] ?? 'No phone available at the moment' }}
                            </p>
                        </div>
                        <div class="action-btn fa fa-envelope">
                            Email Us
                            <p>{{ Settings::getSettingValue('contacts')['contact-info']['mail'] ?? 'No mail available at the moment' }}
                            </p>
                        </div>
                        @if (Settings::getSettingValue('contacts')['contact-info']['address'] ?? '')
                            <div class="action-btn fa fa-map-marker">
                                Address
                                <p>{{ Settings::getSettingValue('contacts')['contact-info']['address'] ?? '' }}</p>
                            </div>
                            <div class="footer-map" style="width: 100%; max-width: 300px; height: 300px;">
                                <iframe
                                    src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY') }}&q={{ Settings::getSettingValue('contacts')['contact-info']['address'] ?? '' }}"
                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        @endif

                        <!-- Phone Field -->
                        <div class="form-field">
                            <label for="phone">Phone Number:</label>
                            <input id="phone" type="tel" name="phone" placeholder="Phone Number" required>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nationality Field -->
                        <div class="form-field">
                            <label for="nationality">Select Nationality:</label>
                            <select id="nationality" name="nationality" required>
                                <option value="">Select your nationality</option>
                            </select>
                            @error('nationality')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Category Field -->
                        <div class="form-field">
                            <label for="email-category">Select Email Category:</label>
                            {{-- {{dd($contacts_filters);}} --}}
                            <select id="email-category" name="email-category" required>
                                <option value="">Select the category of your email</option>
                                @foreach ($contacts_filters as $filter)
                                    <option value="{{ $filter['en']['filter'] }}">
                                        {{ $filter[app()->getLocale()]['filter'] }}</option>
                                @endforeach

                            </select>
                            @error('email-category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Other fields like Name, Email, Subject, Message -->
                    <div class="col-md-6">
                        <div class="form-field">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Your Name" required
                                min="3" max="30">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" placeholder="Your Email" required
                                min="3" max="30">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Subject" required
                                min="3" max="30">
                            @error('subject')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Message" required maxlength="300" style="resize: none;"></textarea>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="bbt" type="submit">Send</button>
            </form>


        </fieldset>
    </div>
</div>



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var phoneInput = document.querySelector("#phone");

            // Initialize intl-tel-input
            var iti = window.intlTelInput(phoneInput, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js" // Optional, for formatting
            });

            // When the form is submitted, append the country code to the phone number
            document.querySelector("form").addEventListener("submit", function() {
                var phoneNumber = iti.getNumber(); // Get the full phone number with the country code
                phoneInput.value = phoneNumber; // Set the value to the phone input field
            });
        });
    </script>

    <script>
        // Initialize phone input
        const phoneInput = document.querySelector("#phone");
        const iti = intlTelInput(phoneInput, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io?token=YOUR_TOKEN') // Replace with your own API token
                    .then((response) => response.json())
                    .then((data) => callback(data.country))
                    .catch(() => callback('us'));
            },
            excludeCountries: ["il"], // Exclude Israel by country code (IL)
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
        });

        // Fetch countries from Restcountries API and populate the dropdown
        const nationalityDropdown = document.querySelector("#nationality");

        fetch("https://restcountries.com/v3.1/all")
            .then(response => response.json())
            .then(data => {
                // Sort countries alphabetically by name
                const sortedCountries = data.filter(country => country.cca2 !==
                        "IL") // Exclude Israel by country code (IL)
                    .sort((a, b) => a.name.common.localeCompare(b.name.common));

                sortedCountries.forEach(country => {
                    const option = document.createElement("option");
                    option.value = country.cca2; // The 2-letter country code
                    option.textContent = country.name.common; // The country's common name
                    nationalityDropdown.appendChild(option);
                });

                // Initialize Select2 on the dropdown for search functionality
                $(nationalityDropdown).select2({
                    placeholder: "Search for a country",
                    width: '100%'
                });
            })
            .catch(error => {
                console.error("Error fetching countries:", error);
            });

        // Example of capturing selected nationality
        nationalityDropdown.addEventListener("change", () => {
            const selectedNationality = nationalityDropdown.value;
            console.log("Selected Nationality:", selectedNationality);
        });
    </script>
@endsection
