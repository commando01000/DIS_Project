<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $direction ?? 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,400;1,100;1,300;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,400;1,100;1,300;1,400&display=swap"
        rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Edu+AU+VIC+WA+NT+Arrows:wght@400..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,400;1,100;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css">


    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @yield('css')


</head>

<header>
    @include('Frontend.Shared.nav')
</header>

<body>

    <div class="container-fluid m-0 p-0">
        @include('Shared.loader')
        @yield('content')
    </div>
    <div class="footer-section text-center">
        @include('Frontend.Shared.footer')
    </div>

    <a class="btn sendm" href="{{ Settings::getSettingValue('side-button')['url'] }}" target="_blank">
        <i class="fa fa-brands fa-whatsapp"></i>
        Whatsapp
    </a>

    <button class="arrowup" id="arrowup" onclick="window.location.href='#home';">
        <span class="fa fa-arrow-up"></span>
    </button>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- QR Code JS -->
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @yield('js')

    <script>
        $(document).ready(function() {
            // Show loader during page load

            $(window).on('load', function() {
                $('.loader').show();
                setTimeout(function() {
                    $('#loaderWrapper').hide();
                    $('.content').fadeIn();
                }, 1500);
            });

            setTimeout(function() {
                $('#loaderWrapper').hide();
                $('.content').fadeIn();
            }, 2000); // Force hide loader after 2 seconds if the load event fails


            // Generate QR codes for cards with the "qr-code" class
            $('.card').each(function() {
                const $qrContainer = $(this).find('.qr-code');
                const url = $qrContainer.attr('data-url');
                if (url) {
                    new QRCode($qrContainer[0], { // Use the DOM element with $qrContainer[0]
                        text: url,
                        width: 100,
                        height: 100,
                        colorDark: "#333333",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H,
                    });
                }
            });
        });
    </script>
</body>

</html>
