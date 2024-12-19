<div id="our-team" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-users">TEAM</h2>
    {{-- {{dd($testimonials->toArray());}} --}}
    <h1>FFFFFFFFFFFFFFFFFFFFF</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        @foreach ($testimonials as $member)
            <div class="card position-relative">
                <img src="{{ asset($member-> image) ?? 'image here' }}" alt="{{$member-> name[app()->getLocale()] ?? 'name image here'}}">
                <h3>{{$member->name[app()->getLocale()] ?? 'name here'}}</h3>
                <div class="qr-code" data-url="{{$member-> profileURL[app()->getLocale()] ?? 'Profile URL here'}}"></div>
            </div>
        @endforeach
    </div>
    <div class="gradient-line"></div>
</div>
