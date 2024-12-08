<div id="projects"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('projects')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-bars">{{ translate('projects')[app()->getLocale()]['section_title'] ?? 'Projects' }}</h2>
    <h1>OUR PROJECTS</h1>
    <div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
        @foreach ($projects as $project)
            <div class="project-card" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong3"
                data-name="{{ $project->name[app()->getLocale()] ?? 'name here' }}"
                data-image="{{ asset($project->image) }}"
                data-description="{{ $project->description[app()->getLocale()] ?? 'description here' }}">
                <img src="{{ asset($project->image) ?? 'image here' }}" class="card-img-top"
                    alt="{{ $project->name[app()->getLocale()] ?? 'name here' }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->name[app()->getLocale()] ?? 'name here' }}</h5>
                    <p class="card-text">{{ $project->description[app()->getLocale()] ?? 'description here' }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
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
    <div class="gradient-line"></div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('exampleModalLong3');

            // Add an event listener to capture clicks on project cards
            document.querySelectorAll('.project-card').forEach(card => {
                card.addEventListener('click', function() {
                    // Get data attributes from the clicked card
                    const name = card.getAttribute('data-name');
                    const image = card.getAttribute('data-image');
                    const description = card.getAttribute('data-description');

                    // Update the modal content
                    modal.querySelector('#modalTitlepro').textContent = name;
                    modal.querySelector('#modalImagepro').setAttribute('src', image);
                    modal.querySelector('#modaldiscriptionpro').textContent = description;
                });
            });
        });
    </script>
</div>
