@extends('Frontend.Shared.layout')
@section('title', 'Contact Us')
@section('css')
    <style>
        .contact-form {
            max-width: 700px;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to right,
                    rgb(250, 249, 249) 10%,
                    rgb(144, 155, 156) 90%);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            margin: auto;
            font-weight: bold;
        }



        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
            color: rgb(37, 36, 36);
            background-color: rgb(130, 193, 135);
            clip-path: polygon(0 0, 100% 0, 90% 100%, 0 100%);

        }


        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
            /* Added margin-top */
        }


        .form-column {
            flex: 1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .form-group input,
        .form-group textarea {
            background: transparent;
            color: #fff;
            padding: 10px 15px;
            border: 1px solid #555;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
            font-size: 0.95em;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #656512;
            /* Highlight color */
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .form-group span {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #252524;
            pointer-events: none;
            transition: all 0.3s ease;
            font-size: 0.9em;
        }

        .form-group input:focus+span,
        .form-group textarea:focus+span {
            top: -10px;
            font-size: 0.8em;
            color: black;
        }

        .form-group input:not(:placeholder-shown)+span,
        .form-group textarea:not(:placeholder-shown)+span {
            top: -15px;
            font-size: 0.8em;
            color: black;
        }

        .form-group .required {
            color: black;
            margin-left: 5px;
        }

        .send-button {
            text-align: center;
            margin-top: 20px;
        }

        .send-button button {
            color: rgb(37, 36, 36);
            padding: 12px 25px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            text-transform: uppercase;
            background-color: rgb(102, 162, 107);
            text-transform: uppercase;
            font-size: 1.2em;
            font-weight: bold;
            letter-spacing: 0.05em;
            transition: all 0.3s ease, clip-path 0.3s ease;
            outline: none;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

        }

        .send-button button:hover {
            background-color: rgb(134, 181, 138);
        }
    </style>
@endsection

@section('content')

    <div class="mb-5 contact-form p-5 mt-5 m-auto overflow-hidden text-center justify-content-center align-items-center">
        <h2 class="animate__animated animate__backInLeft">@lang('translation.Contact-Us')</h2>
        <form action="/send-message" method="POST">
            <!-- Full Name and Phone Number -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" id="full_name" name="full_name" placeholder=" " required>
                        <span>@lang('translation.Full-Name') <span class="required"></span></span>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <input type="tel" id="phone" name="phone" placeholder=" " required>
                        <span>@lang('translation.Phone-Number') <span class="required"></span></span>
                    </div>
                </div>
            </div>

            <!-- Email and Subject -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder=" " required>
                        <span>@lang('translation.Email') <span class="required"></span></span>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder=" " required>
                        <span>@lang('translation.Subject') <span class="required"></span></span>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="form-group">
                <textarea id="message" name="message" placeholder=" " required></textarea>
                <span>@lang('translation.Message') <span class="required"></span></span>
            </div>

            <!-- Submit Button -->
            <div class=" send-button animate__animated animate__backInRight">
                <button type="submit">@lang('translation.Send-Message')</button>

            </div>
        </form>
    </div>

@endsection
