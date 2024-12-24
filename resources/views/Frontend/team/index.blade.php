<style>
    .card {
        width: 280px;
        height: 280px;
        background: white;
        border-radius: 32px;
        padding: 3px;
        position: relative;
        box-shadow: #604b4a30 0px 70px 30px -50px;
        transition: all 0.5s ease-in-out;
    }

    .card .profile-pic {
        position: absolute;
        width: calc(100% - 6px);
        height: calc(100% - 6px);
        top: 3px;
        left: 3px;
        border-radius: 29px;
        z-index: 1;
        border: 0px solid #fbb9b6;
        overflow: hidden;
        transition: all 0.5s ease-in-out 0.2s, z-index 0.5s ease-in-out 0.2s;
    }

    .card .profile-pic img {
        -o-object-fit: cover;

        width: 100%;
        height: 100%;
        -o-object-position: 0px 0px;
        object-position: 0px 0px;
        transition: all 0.5s ease-in-out 0s;
    }

    .card .profile-pic svg {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: 0px 0px;
        object-position: 0px 0px;
        transform-origin: 45% 20%;
        transition: all 0.5s ease-in-out 0s;
    }

    .card .bottom {
        position: absolute;
        bottom: 3px;
        left: 3px;
        right: 3px;
        background: #e67e22;
        top: 80%;
        border-radius: 29px;
        z-index: 2;
        box-shadow: rgba(96, 75, 74, 0.1882352941) 0px 5px 5px 0px inset;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1) 0s;
    }

    .card .bottom .content {
        position: absolute;
        bottom: 0;
        left: 1.5rem;
        right: 1.5rem;
        height: 160px;
    }

    .card .bottom .content .name {
        display: block;
        font-size: 1.2rem;
        color: white;
        font-weight: bold;
    }

    .card .bottom .content .about-me {
        display: block;
        font-size: 0.9rem;
        color: white;
        margin-top: 1rem;
    }

    .card .bottom .bottom-bottom {
        position: absolute;
        bottom: 1rem;
        left: 1.5rem;
        right: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card .bottom .bottom-bottom .social-links-container {
        display: flex;
        gap: 1rem;
    }

    .card .bottom .bottom-bottom .social-links-container svg {
        height: 20px;
        fill: white;
        filter: drop-shadow(0 5px 5px rgba(165, 132, 130, 0.1333333333));
    }

    .card .bottom .bottom-bottom .social-links-container svg:hover {
        fill: #f55d56;
        transform: scale(1.2);
    }

    .card .bottom .bottom-bottom .button {
        background: white;
        color: #e67e22;
        border: none;
        border-radius: 20px;
        font-size: 0.6rem;
        padding: 0.4rem 0.6rem;
        box-shadow: rgba(165, 132, 130, 0.1333333333) 0px 5px 5px 0px;
    }

    .card .bottom .bottom-bottom .button:hover {
        background: #f55d56;
        color: white;
    }

    .card:hover {
        border-top-left-radius: 55px;
    }

    .card:hover .bottom {
        top: 20%;
        border-radius: 80px 29px 29px 29px;
        transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1) 0.2s;
    }

    .card:hover .profile-pic {
        width: 100px;
        height: 100px;
        aspect-ratio: 1;
        top: 10px;
        left: 10px;
        border-radius: 50%;
        z-index: 3;
        border: 7px solid #fbb9b6;
        box-shadow: rgba(96, 75, 74, 0.1882352941) 0px 5px 5px 0px;
        transition: all 0.5s ease-in-out, z-index 0.5s ease-in-out 0.1s;
    }

    .card:hover .profile-pic:hover {
        transform: scale(1.3);
        border-radius: 0px;
    }

    .card:hover .profile-pic img {
        transform: scale(2.5);
        -o-object-position: 0px 25px;
        object-position: 0px 25px;
        transition: all 0.5s ease-in-out 0.5s;
    }

            .card:hover .profile-pic svg {
                transform: scale(2.5);
                transition: all 0.5s ease-in-out 0.5s;
            }

            .qr-code:hover {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 100px;
                height: 100px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 4;
                /* Ensure it appears above other elements */
            }

            .qr-code img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                border-radius: 4px;
            }

            /* QR Code default style */
            .qr-code {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 50px;
                height: 50px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 4;
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }

            /* Hover effect when the card is hovered */
            .card:hover .qr-code {
                transform: scale(1.2);
                /* Enlarges the QR code */
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
                /* Adds a stronger shadow */
            }

            /* Optional: Hover effect on QR code itself */

        </style>
        <div class="card">
            <div class="profile-pic">
                <img src="{{ asset('assets/images/profiles/users/profile.jpeg') }}" alt="profile pic" loading="lazy" />
            </div>

            <div class="bottom">
                <div class="qr-code">
                    <img src="{{ asset('assets/images/profiles/users/profile.jpeg') }}" alt="profile pic" loading="lazy" />
                </div>
                <div class="content">
                    <span class="name">My Name</span>
                    <span class="about-me">Lorem ipsum dolor sit amet consectetur adipisicinFcls
                    </span>
                </div>
                <div class="bottom-bottom">
                    <button class="button">Contact Me</button>

                    <button class="button">Profile</button>
                </div>
            </div>
        </div>

        {{-- @php
            dd($testimonials);
        @endphp --}}
        {{-- @foreach ($testimonials as $member)
            <div class="card position-relative">
                <p>{{ $member->role[app()->getLocale()] ?? 'role here' }}</p>
                <img src="{{ asset($member->image) ?? 'image here' }}"
                    alt="{{ $member->name[app()->getLocale()] ?? 'name image here' }}">
                <h3>{{ $member->name[app()->getLocale()] ?? 'name here' }}</h3>
                <a class="qr-code" href="{{ route('profile', ['id' => $member->id]) }}"
                    data-url="{{ route('profile', ['id' => $member->id]) }}">
                </a>

                {{-- Supraa 20-12-2024 --}}

        {{-- @if (!empty($member->social_media))
                    @foreach ($member->social_media as $platform => $link)
                        <a href="{{ $link }}" target="_blank" class="d-block">
                            @php
                                dd($platform);
                            @endphp
                            {{ ucfirst($platform) }}
                        </a>
                    @endforeach
                @else
                    N/A
                @endif --}}
    </div>
</div>
<div class="gradient-line"></div>
</div>
