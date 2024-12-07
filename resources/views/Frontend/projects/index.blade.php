<div id="projects" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-bars">PROJECTS</h2>
    <h1>OUR PROJECTS</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        <div class="card" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            <img src="{{ asset('assets/images/1.jpg') }}" class="card-img-top" alt="watch">
            <div class="card-body">
                <h5 class="card-title">Watch</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>

        <div class="card" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            <img src="{{ asset('assets/images/2.jpg') }}" class="card-img-top" alt="hand-watch">
            <div class="card-body">
                <h5 class="card-title">Hand-Watch</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>

        <div class="card" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            <img src="{{ asset('assets/images/3.jpg') }}" class="card-img-top" alt="shoes">
            <div class="card-body">
                <h5 class="card-title">Shoes</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>

        <div class="card" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            <img src="{{ asset('assets/images/2.jpg') }}" class="card-img-top" alt="hand-watch">
            <div class="card-body">
                <h5 class="card-title">Hand-Watch</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Image Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src={{ asset('assets/images/3.jpg') }} alt="Image description" class="img-fluid mb-3">
                        <p>This is the description of the image shown above.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
