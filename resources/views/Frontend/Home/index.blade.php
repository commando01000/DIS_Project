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
        //JS for Client Cards
        document.addEventListener('DOMContentLoaded', function() {
            const clientCards = document.querySelectorAll('.client-card');
            const modal = document.getElementById('exampleModalLong2');
            const modalImage = document.getElementById('modalImage');
            const modalDate = document.getElementById('modalDate');
            const modalModules = document.getElementById('modalModules');
            const modalTitle = document.getElementById('modalTitle');

            clientCards.forEach((card) => {
                card.addEventListener('click', function() {
                    const clientId = card.getAttribute('data-id');
                    const clientName = card.getAttribute('data-name');
                    const clientImage = card.getAttribute('data-image');
                    const clientModules = card.getAttribute(
                        'data-modules'); // Get the comma-separated modules string

                    // Update modal content dynamically
                    modalImage.src = clientImage;
                    modalDate.textContent =
                        `Date: ${new Date().toLocaleDateString()}`; // Example date

                    // Display modules in the modal
                    modalModules.innerHTML =
                        `<strong>Modules:</strong> ${clientModules}`; // Display as a string

                    // Set the client name in the modal title
                    modalTitle.textContent = clientName; // Update the title with client name
                });
            });
        });



        //JS for Project Cards

        document.addEventListener('DOMContentLoaded', function() {
            const modalpro = document.getElementById('exampleModalLong3');
            const modalImagepro = document.getElementById('modalImagepro');
            const modalTitlepro = document.getElementById('modalTitlepro');
            const modalDescriptionpro = document.getElementById('modaldiscriptionpro');

            // Event delegation for dynamically generated cards
            document.querySelector('.cards').addEventListener('click', function(event) {
                const pcard = event.target.closest('.project-card');
                if (pcard) {
                    // Retrieve data attributes
                    const projectName = pcard.getAttribute("project-Name") || "Untitled Project";
                    const projectImage = pcard.getAttribute("project-Image") || "default-image-path.jpg";
                    const projectDescription = pcard.getAttribute("project-Description") || "No description available.";

                    // Update the modal's content
                    modalTitlepro.textContent = projectName;
                    modalImagepro.src = projectImage;
                    modalDescriptionpro.textContent = projectDescription;
                }
            });
        });
    </script>
@endsection
