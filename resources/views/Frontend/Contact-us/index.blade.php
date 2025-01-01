<style>
    input {
        height: 30px;
        width: 90%;
    }

    select {
        height: 40px;
        width: 90%;
        font-size: 13px;
        justify-content: center;
        align-content: center;
    }
</style>
<div id ="contact"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('contacts')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-phone">{{ translate('contacts')['section_title'] ?? 'Contact us' }}</h2>
    <h1>{{ translate('contacts')['title'] ?? 'contact' }} </h1>

    <div class="contact-container">
        <!-- Left Div for Buttons -->

        <div class="left-div ">
            <div class="action-btn fa fa-phone">
                Phone
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
                    <p> {{ Settings::getSettingValue('contacts')['contact-info']['address'] ?? '' }}</p>
                </div>
                <div class="footer-map" style="width: 100%; max-width: 300px; height: 300px;">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY') }}&q={{ Settings::getSettingValue('contacts')['contact-info']['address'] ?? '' }}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
            <div class="form-field">
                <label for="phone">Phone Number:</label>
                <input class="form-control" id="phone" type="tel" name="phone" placeholder="Phone Number"
                    required>
            </div>

            <div class="form-field">
                <label for="nationality">Select Nationality:</label>
                <select id="nationality" name="nationality" required>
                    <option value="">Select your nationality</option>
                </select>
            </div>

            <div class="form-field">
                <label for="email-category">Select Email Category:</label>
                <select id="email-category" name="email-category" required>
                    <option value="">Select the category of your email</option>
                    @php
                        $filterData = Settings::getSettingValue('contacts')['filter-data'] ?? null;
                    @endphp
                    @if ($filterData != null)
                        @foreach ($filterData as $filter_data)
                            <option value="{{ $filter_data['en']['filter'] ?? '' }}">
                                {{ $filter_data[app()->getLocale()]['filter'] ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <!-- Right Div for Form -->
        <div class="right-div mt-4">
            <div class="contact-form">
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="form-field">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required
                            min="3" max="30">
                    </div>

                    <div class="form-field">
                        <label for="mail">Your Email</label>
                        <input type="mail" id="mail" name="mail" placeholder="Your Email" required
                            min="3" max="30">
                    </div>
                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Subject" required
                            min="3" max="30">
                    </div>

                    <div class="form-field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Message" required maxlength="300" style="resize: none;"></textarea>
                    </div>

                    <button class="bbt" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
