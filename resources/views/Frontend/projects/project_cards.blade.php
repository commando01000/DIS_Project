<div class="cards justify-content-center d-flex flex-wrap gap-5 mt-5">
    @foreach ($projects as $project)
        <div class="project-card" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong3"
            data-name="{{ $project->name[app()->getLocale()] ?? 'name here' }}" data-image="{{ asset($project->image) }}"
            data-description="{{ $project->description[app()->getLocale()] ?? 'description here' }}">
            <img src="{{ asset($project->image) ?? 'image here' }}" class="card-img-top"
                alt="{{ $project->name[app()->getLocale()] ?? 'name here' }}">
            <div class="card-body">
                <h5 class="card-title">{{ $project->name[app()->getLocale()] ?? 'name here' }}</h5>
                <p class="card-text">
                    {{ \Illuminate\Support\Str::limit($project->description[app()->getLocale()] ?? 'description here', 18) }}
                </p>
            </div>
        </div>
    @endforeach
</div>

<div class="pagination-links" data-section="projects">
    {{ $projects->links() }}
</div>
