<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Edu+AU+VIC+WA+NT+Arrows:wght@400..700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lora:ital,wght@0,400..700;1,400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,400;1,100;1,300;1,400&family=Yuji+Mai&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Profile</title>
    <style>
        .proimg {
            border-radius: 20%;
            width: 400px;
            height: 500px;
            background-size: cover;
            display: inline;
            background-position: center;
            background-repeat: no-repeat;
        }

        .ttl {
            color: #6f5034;
            text-align: center;
            font-family: Lora, serif;
        }

        .horizontal-line {
            height: 1px;
            background: linear-gradient(to left, #e67e22 5%, rgb(230, 230, 230) 95%);
            box-shadow: 0 4px 6px 0 #868482;
        }

        img {
            box-shadow: 0 4px 6px 0 #868482;
            margin-left: 50px;
            margin-right: 50px;
        }

        .vertical-line {
            width: 1px;
            height: 500px;
            background: linear-gradient(to left, #e67e22 5%, rgb(230, 230, 230) 95%);
            box-shadow: 0 4px 6px 0 #868482;
        }

        .co {
            display: flex;
            flex-direction: row;
        }

        .coo {
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: Lora, serif;
            margin-left: 10%;
        }

        .prow {
            display: flex;
            gap: 10px;
            flex-direction: row;
        }

        h4 {
            color: #6f5034 !important;
            height: 30px;
        }

        p {
            width: 100%;
        }

        .fab {
            color: #6f5034;
            font-size: 30px;
            margin-right: 20px;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 932px) {
            .co {
                flex-direction: column;
                align-items: center;
            }

            .proimg {
                margin: 0 auto;
            }

            .vertical-line {
                width: 100%;
                height: 1px;
            }

            .coo {
                margin-left: 0;
            }

            .prow {
                align-items: flex-start;
            }

            .prow h4 {
                margin-bottom: 5px;
            }

            .prow p {
                width: 90%;
                margin-bottom: 10px;
            }

            .fab {
                font-size: 25px;
                margin-right: 10px;
            }
        }

        @media (max-width: 480px) {
            .ttl {
                font-size: 1.5rem;
            }

            .fab {
                font-size: 20px;
                margin-right: 5px;
            }
        }

        .pw {
            margin-top: 5px;
            text-align: justify;
            line-height: 1.6;
        }
    </style>
</head>

<body class="container-xxl">
    <div>
        <h1 class="ttl mt-3">
            {{ $decodedTestimonial['name'][app()->getLocale()] ?? 'Name not available' }}
        </h1>
        <div class="horizontal-line"></div>
    </div>

    <div class="co">
        {{-- {{dd($decodedTestimonial['image']);}} --}}
        <img class="proimg mt-5" src="{{ asset($decodedTestimonial['image']) ?? 'default-image.jpg' }}"
            alt="{{ $decodedTestimonial['name'][app()->getLocale()] ?? 'Name image' }}">
        <div class="vertical-line mt-5"></div>
        <div class="coo mt-5">
            <div class="prow">
                <h4>Name:</h4>
                <p>{{ $decodedTestimonial['name'][app()->getLocale()] ?? 'Name not available' }}</p>
            </div>
            <div class="prow">
                <h4>Role:</h4>
                <p>{{ $decodedTestimonial['role'][app()->getLocale()] ?? 'Role not available' }}</p>
            </div>
            @foreach ($decodedTestimonial['social_media'] as $key => $value)
                @if (Str::isUrl($value) === false)
                    <div class="prow">
                        <h4>{{ $key }}</h4>
                        <p>{{ $value ?? 'Phone not available' }}</p>
                    </div>
                @endif
            @endforeach
            <h4>Biography:</h4>
            <p class="pw">
                {{ $decodedTestimonial['description'][app()->getLocale()] ?? 'Description not available' }}
            </p>
            <div id="socialMedia" class="d-flex flex-row nowrap">
                @foreach ($decodedTestimonial['social_media'] as $key => $link)
                    @if (Str::isUrl($link) === true)
                        <div class="prow flex-row align-items-center">
                            <a href="{{ $link }}" target="_blank"> <i
                                    class="fab fa-brands fa-{{ strtolower($key) }}"></i>
                            </a>
                        </div>
                    @endif
                @endforeach

            </div>

        </div>
    </div>
    <div class="horizontal-line mt-5"></div>
</body>

</html>
