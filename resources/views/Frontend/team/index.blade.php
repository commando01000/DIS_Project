<div id="our-team" class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('testimonials')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-users">TEAM</h2>
    {{-- {{dd($testimonials->toArray());}} --}}
    <h1>FFFFFFFFFFFFFFFFFFFFF</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        {{-- @php
            dd($testimonials);
        @endphp --}}
        @foreach ($testimonials as $member)
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
        @endforeach
    </div>
    <div class="gradient-line"></div>
</div>
