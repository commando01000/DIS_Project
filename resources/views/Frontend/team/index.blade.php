<div id="our-team" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-users">TEAM</h2>
    {{dd($testimonials->toArray());}}
    <h1>FFFFFFFFFFFFFFFFFFFFF</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        
        <div class="card position-relative">
            <img src="{{ asset('assets/images/testimonials/1.jpg') }}" alt="Ahmed CEO">
            <h3>Ahmed Abdelhay</h3>
            <div class="qr-code" data-url="https://example.com/ahmed-ceo"></div>
        </div>

        <div class="card position-relative">
            <img src="{{ asset('assets/images/testimonials/2.jpg') }}" alt="Ahmed operation">
            <h3>Ahmed Operation</h3>
            <div class="qr-code" data-url="https://example.com/ahmed-ceo"></div>
        </div>
    </div>
    <div class="gradient-line"></div>
</div>
