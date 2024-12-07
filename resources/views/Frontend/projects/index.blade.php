<div id="projects" class="gh adjusted-scrolling w-75 mx-auto">
    <h2 class="fa fa-bars">PROJECTS</h2>
    <h1>OUR PROJECTS</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">

        <div class="project-card" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModalLong3">


            @foreach ($projects as $project)
                <img project-Image="{{asset( $project->image) }}" src="{{ asset($project->image) }}" class="card-img-top">
                <div class="card-body">
                    <h5  project-Name="{{ $project->name[app()->getLocale()] }}" class="card-title">{{ $project->name[app()->getLocale()] }}</h5>
                    <p project-Description="{{ $project->description[app()->getLocale()] }}" class="card-text">{{ $project->description[app()->getLocale()] }}</p>
                </div>
            @endforeach

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 id="modalTitlepro">Project Name</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body text-center">

                        <img id="modalImagepro" src="" alt="Project Image" class="img-fluid mb-3">
                        <p id="modaldiscriptionpro"></p>

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
