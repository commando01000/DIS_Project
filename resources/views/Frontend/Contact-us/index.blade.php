<div class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-phone">CONTACT</h2>
    <h1>{{ translate('contact_us') }}</h1>

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

<style>
    .contact-container {
        display: flex;
        justify-content: space-between;
    }

    .left-div {
        width: 20%;
        margin-left: 20px;
        /* Adjust width of left div as needed */
    }

    .right-div {
        width: 90%;
        /* Adjust width of right div as needed */


    }

    .action-btn {
        width: 20%;
        margin-top: 50px;
        border:solid 2px #e67e22;
        background-color: white;
        color: #e67e22;
        border-radius: 30px;
        font-size: 30px;
        padding: 15px;
        width: 300px;
        height: 115px;;


    }

    .action-btn p {

        padding: 8px;
        color: black;
        font-size: 16px;
    }

    .contact-form {
        padding: 20px;
        margin-left: 32%;
    }

    .form-field {
        margin-top: 15px;
    }

    label {
        font-size: 20px;
        color: #333;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 150px;
        resize: vertical;
    }

    .bbt {
        width: 20%;
        padding: 12px;
        background-color: #e67e22;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        margin-left: 40%;
    }

    button:hover {
        background-color: #d09f74;
    }
</style>
