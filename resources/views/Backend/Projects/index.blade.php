@extends('Backend.Shared.layout')

@section('title', 'Projects')



@section('content')

    <div id="projects" class="themed-box">
        @include('Shared.loader')
        <h2>Project</h2>
        <form action="{{ route('update.settings.projects') }}" enctype="multipart/form-data" method="POST">
            @csrf

            @include('Backend.shared.section-translation', [
                'settings' => Settings::getSettingValue('projects'),
            ])

            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('projects'),
                'formName' => 'projects',
            ])
        </form>
    </div>
    <div id="projects-tables" class="themed-box">
        <h2>Project Data</h2>
        {{-- Create Project Button --}}
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success mb-3">Create Project</a>
        <!-- Table displaying Projects information -->
        <table id="projectsTable" class="table content table-bordered">
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd(app()->getLocale());}} --}}
                <!-- Loop through each project and display its details -->
                {{-- {{dd($projects);}} --}}
                @foreach ($projects as $project)
                    <tr>
                        {{-- {{dd($project->name);}} --}}
                        <td>{{ $project->name[app()->getLocale()] }}</td>
                        <td>
                            {{ $project->description[app()->getLocale()] }}
                        </td>
                        {{-- <td>{{ $project->name}}</td> --}}
                        <td>
                            <img class="dt-image" src="{{ asset($project->image) }}"
                                alt="{{ $project->name[app()->getLocale()] }}" class="img-fluid" />
                            {{-- alt="{{ $project->name }}" class="img-fluid" /> --}}
                        </td>

                        <td>
                            <!-- Edit and delete actions for each project -->
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
    <!-- JavaScript for Form Validation -->
    <script>
        $(window).on('load', function() {
            // Show the loader when the page starts loading
            $('.loader').show();

            // Set a 1.5-second delay before hiding the loader and showing the content
            setTimeout(function() {
                $('#loaderWrapper').fadeOut(); // Ensure the loader wrapper fades out
                $('.content').fadeIn(); // Ensure the main content fades in
            }, 1500); // 1500 milliseconds = 1.5 seconds

        });
    </script>

    <script>
        // Call the initializer toggle function
        $(document).ready(function() {
            const formName = $(this).data('form'); // Extract form name from the data attribute
            const toggleId = $(this).attr('id'); // Get the specific toggle ID
            const baseUrl = "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
            const csrfToken = '{{ csrf_token() }}';
            // Call the initializeTable function
            initializeTable({
                formName: 'projectsTable'
            });
            initializer({
                baseUrl: baseUrl.replace(':form', formName),
                csrf_token: csrfToken,
                formName: formName
            });
        });
    </script>
@endsection
