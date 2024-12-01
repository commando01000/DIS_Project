@extends('Frontend.Shared.layout')

@section('title', 'Home')

@section('css')

    <style>
        .ad {
            font-family: "Edu AU VIC WA NT Arrows", cursive;
            color: white;
            background-color: rgb(26, 137, 36);
            width: 110%;
            border-radius: 5px;
            clip-path: polygon(0 0, 100% 13%, 90% 100%, 0 100%);
            border-radius: 5px;
            font-size: 40px;
        }

        p3 {
            font-family: Caveat;
            color: rgb(67, 60, 60);
            font-size: 40px;
            width: 65%;
            border-radius: 5px;

        }

        .top {
            background-color: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            gap: 5px;
            box-shadow: 0 4px 8px rgb(66, 175, 75);
            border: 1px none #cccccc;
            width: 40%;

        }

        .mySwiper {
            width: 100%;
            max-width: 1300px;
            height: auto;
            max-height: 500px;
            aspect-ratio: 3 / 2;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 6px rgb(66, 175, 75);
            border-radius: 15px;
            position: relative;


        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .autoplay-progress {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 10;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--swiper-theme-color);
        }

        .autoplay-progress svg {
            --progress: 0;
            position: absolute;
            left: 0;
            top: 0px;
            z-index: 10;
            width: 100%;
            height: 100%;
            stroke-width: 4px;
            stroke: var(--swiper-theme-color);
            fill: none;
            stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
        }

        h5 {
            color: black;
            font-family: "Lora";
            font-size: 15px;
            margin-left: 200px;

        }

        .line-horizontal {
            border: none;
            border-top: 2px solid rgb(59, 150, 67);
            width: 100%;
        }

        .im {

            box-shadow: 0 4px 6px rgb(66, 175, 75);

            border-radius: 10px;

        }


        .sendm:hover {
            background-color: rgb(89, 173, 89);
            width: 130px;
            overflow: hidden;
        }

        .viewteam:hover {
            background-color: rgb(89, 173, 89);
            overflow: hidden;
        }

        p4 {
            font-size: 20px;
            font-style: italic;

        }

        @media (max-width:991.5px) {
            .top {
                width: 100% !important;
            }

            .mrow{
                width: 100% !important;
            }
            .p2,
            .p1,
            .p3 {
                font-size: 20px !important;
            }
        }

        .sendm {
            background: rgb(30, 161, 30);
            color: white;
            height: 30px;
            font-size: small;
            position: fixed;
            bottom: 20%;
            right: 1px;
            border-radius: 10px;
            padding: 10px 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: width 0.3s, background-color 0.3s;
            overflow: hidden;
            white-space: nowrap;
            width: 45px;
            margin-right: -14px;


        }

        .viewteam {
            background: rgb(30, 161, 30);
            color: white;
            display: center;
            height: 50px;
            border-radius: 15px;
            transition: width 0.3s, background-color 0.3s;
            width: 175px;
            box-shadow: 0 4px 6px rgb(66, 175, 75);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            margin: 0 auto;
        }


        .sendm:hover {
            background-color: rgb(89, 173, 89);
            width: 130px;
            overflow: hidden;
        }

        .viewteam:hover {
            background-color: rgb(89, 173, 89);
            overflow: hidden;
        }

        p4 {
            font-size: 20px;
            font-style: italic;


        }
    </style>
@endsection

@section('content')
    <br>
    <div class ='top m-auto overflow-hidden text-center'>
        <div class="ad animate__animated animate__backInLeft m-auto overflow-hidden">
            <p1 class=" m-auto overflow-hidden">
                EL
            </p1>
            <p2 class=" m-auto overflow-hidden">
                MODON
            </p2>
        </div>
        <p3 class ='m-auto overflow-hidden text-center animate__animated animate__backInRight'>
            Fundation
        </p3>
    </div>
    <div class="mrow row w-75 m-auto overflow-hidden">
        <div class="col-md-12">

            @include('Frontend.Projects-Swiper.swiper')

            <div class ='animate__animated animate__backInLeft  justify-content-center align-items-center '>
                <div class="row mt-4 pt-4">
                    <h5 class ='m-auto overflow-hidden fa fa-users'>
                        OUR TEAM
                        <hr class="line-horizontal">
                        <h6 class ='fa fa-star'> MEET OUR LEADERSHIP </h6>
                    </h5>
                    <div class="im col-md-4 mb-4">
                        <img src="{{ asset('assets/images/demo1.png') }}" alt="d1" class="img-fluid">
                        <p4>Mohamed Mortaga</p4>
                        <br>
                        <p5>CEO</p5>
                    </div>
                    <div class="im col-md-4 mb-4">
                        <img src="{{ asset('assets/images/demo2.png') }}" alt="d2" class="img-fluid">
                        <p4>Mahmoud Ibrahem</p4>
                        <br>
                        <p5>Operation Manager</p5>
                    </div>
                    <div class="im col-md-4 mb-4">
                        <img src="{{ asset('assets/images/demo3.png') }}" alt="d3" class="img-fluid">
                        <p4>Jeo Sameh</p4>
                        <br>
                        <p5>Operation Manager</p5>
                    </div>

                </div>
                <button class="viewteam fa fa-superpowers  " onclick="">
                    View All
                </button>

            </div>

        </div>

    </div>
    <br><br>
    <div>
        <div>
            <button class="sendm fa fa-paper-plane  " onclick="">
                Send Message
            </button>
        </div>

    </div>


@endsection

@section('js')
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");

        const swiperEl = document.querySelector("swiper-container");
        swiperEl.addEventListener("autoplaytimeleft", (e) => {
            const [swiper, time, progress] = e.detail;
            progressCircle.style.setProperty("--progress", 1 - progress);
            progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        });
    </script>
@endsection
