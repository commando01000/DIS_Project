<div id ="contact" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-phone">CONTACT</h2>
    <h1>{{-- {{ translate('contact_us') }} --}} CONTACT US</h1>

    <div class="contact-container">
        <!-- Left Div for Buttons -->
        <div class="left-div">
            <div class="action-btn fa fa-map-marker">
                Address
                <p> A108 Adam Street, New York, NY 535022</p>
            </div>
            <div class="action-btn fa fa-phone">
                Phone
                <p>+1 5589 55488 55</p>
            </div>
            <div class="action-btn fa fa-envelope">
               Email Us
                <p>info@example.com</p>
            </div>
        </div>

        <!-- Right Div for Form -->
        <div class="right-div">
            <div class="contact-form">
                <form action="#" method="POST">
                    <div class="form-field">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>

                    <div class="form-field">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>

                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    </div>

                    <div class="form-field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Message" required></textarea>
                    </div>

                    <button class="bbt" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

