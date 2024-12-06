@extends('Frontend.Shared.layout')

@section('title', 'Home')

@section('css')
    <style>
        .top {
            text-align: center;
            background: rgb(230, 230, 230);
            width: 100%;
            margin: 0 auto !important;
            padding: 150px 0;


        }

        h1 {
            font-size: 3rem !important;
            font-weight: bold;
            margin: 0;
        }


        .pp {
            margin: 0;
            padding: 40px 10%;
            /* Use percentage for responsive paddings */
        }

        .tbs {
            margin-left: 30%;
            margin-top: 25px;
            width: 854px;
        }

        .tbm {
            margin-left: 30%;
            margin-top: 25px;
            height: 150px;
            width: 854px;
        }

        .tb {
            margin-left: 30%;
            margin-top: 25px;
            width: 400px;
        }

        .ppp {
            color: #542c08;
            margin: 0;
            padding: 40px 2%;
            font-size: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        @media (min-width: 991.5px) {
            .pp {
                padding: 40px 400px;
                /* Larger padding for wider screens */
            }
        }

        @media (max-width: 767px) {
            .pp {
                padding: 40px 20px;
                /* Smaller padding for mobile devices */
            }
        }

        .sp {
            height: 40%;
            color: #542c08;

        }

        .ReedMore {
            color: Black;
            display: center;
            border-radius: 45px;
            transition: width 0.3s, background-color 0.3s;
            width: 150px;
            background: rgb(230, 230, 230);
            border: solid#e67e22;


        }

        .ReedMore:hover {
            background-color: #e67e22;
            overflow: hidden;
            color: white;
        }

        .gh h2 {
            font-size: 24px;
            color: #777;
            margin-bottom: 5px;
        }

        .gh h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            position: relative;
        }

        .gh h2::after {
            content: '';
            display: block;
            width: 200px !important;
            height: 2px !important;
            background-color: #e67e22;

        }

        .gradient-line {
            height: 1px;
            background: linear-gradient(to left, #e67e22 5%, rgb(230, 230, 230) 95%);
            margin-left: 14%;
            margin-right: 14%;
            margin-top: 5%;
        }

        /* cliets*/
        #clients .swiper swiper-container {
            width: 100%;
            height: 100%;

        }

        #clients swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #clients swiper-slide img {
            display: block;
            width: 220px;
            height: 220px;
            object-fit: cover;
            margin-bottom: 11px;
        }

        #clients swiper-container {
            width: 100%;
            height: 300px;
            margin: 20px auto;
        }
    </style>
@endsection

@section('content')
    <div id="home" class ='top m-auto overflow-hidden cssanimation hu__hu__'>
        <swiper-container class="sp" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
            centered-slides="true" autoplay-delay="5000" autoplay-disable-on-interaction="false">
            <swiper-slide>
                <h1 class='animate__animated animate__backInDown'>
                    Digital Innovative Solution
                </h1>
                <p class='pp animate__animated animate__backInUp'>
                    Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
                    Occaecati
                    alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.
                    Minus et
                    tempore modi architecto.
                </p>
            </swiper-slide>
            <swiper-slide>
                <h1 class='animate__animated animate__backInDown'>
                    We Are Best Desktop Developing Fundation
                </h1>
                <p class='pp animate__animated animate__backInUp'>
                    Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
                    Occaecati
                    alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.
                    Minus et
                    tempore modi architecto.
                </p>
            </swiper-slide>
            <div class="autoplay-progress" slot="container-end">

            </div>
        </swiper-container>
        <button class="ReedMore" onclick="window.location.href='#about-us';">Read More</button>
    </div>

    @include('Frontend.about-us.index')

    <div class="gradient-line"></div>

    @include('Frontend.projects.index')

    <div class="gradient-line"></div>

    @include('Frontend.clients.index')

    <div class="gradient-line"></div>

    @include('Frontend.team.index')

    <div class="gradient-line"></div>

    @include('Frontend.polices.index')

    <div class="gradient-line"></div>

    @include('Frontend.Contact-us.index')


@endsection


@section('js')
    <script>
        < script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" >
    </script>
    </script>
@endsection
