<div id="clients"
    class ="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('clients')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-star">CLIENTS</h2>
    <h1>PIONEER CLIENTS</h1>
    <div class="client-cards d-flex justify-content-center flex-wrap gap-5 mt-5">
        <swiper-container class="mySwiper w-100" slides-per-view="auto"
            breakpoints='{
                "576": { "slidesPerView": 2 },
                "768": { "slidesPerView": 3 },
                "1200": { "slidesPerView": 4 }
            }'
            centered-slides="true" space-between="50" pagination="true" pagination-type="fraction" navigation="true">

            @foreach ($clients as $client)
                <swiper-slide>
                    <div class="client-card" type="button" data-bs-toggle="modal" id="client-card-{{ $client->id }}"
                        data-bs-target="#exampleModalLong2" data-id="{{ $client->id }}"
                        data-name="{{ $client->name[app()->getLocale()] }}" data-image="{{ asset($client->image) }}"
                        data-modules="{{ $client->modules->pluck('name')->join(', ') }}">
                        <!-- Join modules into a string -->
                        <h5>{{ $client->name[app()->getLocale()] }}</h5>
                        <img src="{{ asset($client->image) }}" />
                    </div>
                </swiper-slide>
            @endforeach




        </swiper-container>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- Add an id to the title element for dynamic updates -->
                        <h5 id="modalTitle">Client Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <!-- Client image -->
                        <img id="modalImage" src="" alt="Client Image" class="img-fluid mb-3">
                        <!-- Optional date -->
                        <h6 id="modalDate">Date</h6>
                        <!-- Client modules -->
                        <div id="modalModules"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gradient-line"></div>
</div>
