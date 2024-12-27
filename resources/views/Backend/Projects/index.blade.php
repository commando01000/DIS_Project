@extends('Backend.Shared.layout')

@section('title', 'Projects')



@section('content')

    <div id="projects" class="themed-box">

        <h2>Project</h2>
        <form action="{{ route('update.settings.projects') }}" enctype="multipart/form-data" method="POST">
            @csrf

            @include('Backend.shared.section-translation', [
                'settings' => Settings::getSettingValue('projects'),
            ])

            <!-- Section -->
            {{-- <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="section_title_en" class="form-label">Section (EN)</label>
                    <input type="text" class="form-control" name="section_title_en" id="section_title_en"
                        value="{{ $settings['en']['section_title_en'] ?? '' }}" placeholder="Enter Section Name in English"  />
                    @error('section_title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="section_title_ar" class="form-label">(AR) القسم</label>
                    <input type="text" class="form-control" name="section_title_ar" id="section_title_ar"
                        value="{{ $settings['ar']['section_title_ar'] ?? '' }}" placeholder="أدخل اسم القسم" dir="rtl"  />
                    @error('section_title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!-- Title -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="title_en" class="form-label">Title (EN)</label>
                    <input type="text" class="form-control" name="title_en" id="title_en" value="{{ $settings['en']['title_en'] ?? '' }}"
                        placeholder="Enter Title in English"  />
                    @error('title_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 text-end">
                    <label for="title_ar" class="form-label">(AR) العنوان</label>
                    <input type="text" class="form-control" name="title_ar" id="title_ar" value="{{ $settings['ar']['title_ar'] ?? '' }}"
                        placeholder="أدخل العنوان" dir="rtl"  />
                    @error('title_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div> --}}

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

@section('js')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
    <!-- JavaScript for Form Validation -->

    <script>
        // Call the initializer toggle function
        $(document).ready(function() {
            const formName = $(this).data('form'); // Extract form name from the data attribute
            const toggleId = $(this).attr('id'); // Get the specific toggle ID
            const baseUrl = "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}";
            const csrfToken = '{{ csrf_token() }}';
            // Call the initializeTable function
            initializeTable({
                baseUrl: baseUrl,
                csrf_token: token,
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
