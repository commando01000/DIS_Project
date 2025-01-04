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
            margin-top: 5%;
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif
    <div id="home" class ='top m-auto overflow-hidden cssanimation hu__hu__'>
        <swiper-container class="sp" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
            centered-slides="true" autoplay-delay="5000" autoplay-disable-on-interaction="false">

            @if (empty($swipers))
                <swiper-slide>
                    <h1 class='animate__animated animate__backInDown'>
                        {{ $settings[app()->getLocale()]['title'] ?? 'title here' }}
                    </h1>
                    <p class='pp animate__animated animate__backInUp'>
                        {{ $settings[app()->getLocale()]['description'] ?? 'description here' }}
                    </p>
                </swiper-slide>
            @endif

            @foreach ($swipers as $swiper)
                <swiper-slide>
                    <h1 class='animate_animated animate_backInDown'>
                        {{ $swiper[app()->getLocale()]['title'] ?? 'title here' }}
                    </h1>
                    <p class='pp animate_animated animate_backInUp'>
                        {{ $swiper[app()->getLocale()]['description'] ?? 'description here' }}
                    </p>
                </swiper-slide>
            @endforeach
        </swiper-container>
        <button class="ReedMore" onclick="window.location.href='#about-us';">Read More</button>

    </div>

    @include('Frontend.about-us.index')

    @include('Frontend.projects.index')

    @include('Frontend.clients.index')

    @include('Frontend.team.index')

    @include('Frontend.polices.index')

    @include('Frontend.Contact-us.index')


@endsection


@section('script')
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

            // Handle pagination links for both sections
            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();

                    const url = e.target.closest('.pagination a').href;
                    const section = e.target.closest('.pagination-links').dataset.section;
                    console.log(section);
                    // Perform AJAX request
                    fetch(url + `&section=${section}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        })
                        .then((response) => response.text())
                        .then((html) => {
                            if (section === 'projects') {
                                document.getElementById('project-cards').innerHTML = html;
                            } else if (section === 'testimonials') {
                                document.getElementById('team-cards').innerHTML = html;
                            }
                        })
                        .catch((err) => console.error('Failed to load content:', err));
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('exampleModalLong3');

            // Use event delegation to handle clicks on dynamically loaded project cards
            document.getElementById('projects').addEventListener('click', function(event) {
                const card = event.target.closest('.project-card');
                if (card) {
                    // Get data attributes from the clicked card
                    const name = card.getAttribute('data-name');
                    const image = card.getAttribute('data-image');
                    const description = card.getAttribute('data-description');

                    // Update the modal content
                    modal.querySelector('#modalTitlepro').textContent = name;
                    modal.querySelector('#modalImagepro').setAttribute('src', image);
                    modal.querySelector('#modaldiscriptionpro').textContent = description;
                }
            });
        });
    </script>
@endsection
