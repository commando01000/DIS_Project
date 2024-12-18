<div id ="contact" class="gh adjusted-scrolling w-75 mx-auto ">
    <h2 class="fa fa-phone">{{translate('contacts')['section_title'] ?? 'Contact us'}}</h2>
    <h1>{{ translate('contacts')['title'] ?? 'contact'}} </h1>

    <div class="contact-container">
        <!-- Left Div for Buttons -->
      
        <div class="left-div">
            <div class="action-btn fa fa-phone">
                Phone
                <p>{{Settings::getSettingValue('contacts')['contact-info']['phone'] ?? ''}}</p>
            </div>
            <div class="action-btn fa fa-envelope">
                Email Us
                <p>{{Settings::getSettingValue('contacts')['contact-info']['mail'] ?? ''}}</p>
            </div>
            @if(Settings::getSettingValue('contacts')['contact-info']['address'] != '')
                <div class="action-btn fa fa-map-marker">
                    Address
                    <p> {{Settings::getSettingValue('contacts')['contact-info']['address'] ?? ''}}</p>
                </div>
                <div class="footer-map" style="width: 100%; max-width: 300px; height: 300px;">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY') }}&q={{Settings::getSettingValue('contacts')['contact-info']['address'] ?? ''}}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
            

        </div>

        <!-- Right Div for Form -->
        <div class="right-div">
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
