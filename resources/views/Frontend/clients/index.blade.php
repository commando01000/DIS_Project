<div id="clients" class ="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-star">CLIENTS</h2>
    <h1>PIONEER CLIENTS</h1>
    <div class="client-cards d-flex justify-content-center flex-wrap gap-5 mt-5">
        <swiper-container class="mySwiper w-100" slides-per-view="auto" breakpoints='{
                "576": { "slidesPerView": 2 },
                "768": { "slidesPerView": 3 },
                "1200": { "slidesPerView": 4 }
            }' centered-slides="true" space-between="50" pagination="true" pagination-type="fraction" navigation="true">
            <swiper-slide>
                <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                    <h5>Bank Msr</h5>
                    <img src="{{ asset('assets/images/4.png') }}" alt="watch">
                </div>
            </swiper-slide>
            <swiper-slide>
                <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                    <h5>Bank Msr</h5>
                    <img src="{{ asset('assets/images/2.jpg') }}" alt="watch">
                </div>
            </swiper-slide>
            <swiper-slide>
                <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                    <h5>Bank Msr</h5>
                    <img src="{{ asset('assets/images/3.jpg') }}" alt="watch">
                </div>
            </swiper-slide>
            <swiper-slide>
                <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                    <h5>Bank Msr</h5>
                    <img src="{{ asset('assets/images/1.jpg') }}" alt="watch">
                </div>
            </swiper-slide>
            <swiper-slide>
                <div type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                    <h5>Bank Msr</h5>
                    <img src="{{ asset('assets/images/3.jpg') }}" alt="watch">
                </div>
            </swiper-slide>
        </swiper-container>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Bank Msr</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('assets/images/4.png') }}" alt="Image description" class="img-fluid mb-3">
                        <h6>Date</h6>
                        <p>26/11/2022</p>
                        <h6>Models</h6>
                        <p>This is the description of the image shown above2.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
