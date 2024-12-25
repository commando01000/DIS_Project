<div id="projects"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('projects')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-bars">{{ translate('projects')[app()->getLocale()]['section_title'] ?? 'Projects' }}</h2>
    <h1>OUR PROJECTS</h1>

    <!-- Project Cards -->
    <div id="project-cards">
        @include('Frontend.projects.project_cards')
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
</div>
