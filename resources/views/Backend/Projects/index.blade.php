@extends('Backend.Shared.layout')

@section('title', 'Projects')

@section('css')

    <style>
        .input-group-text {
            width: 100px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }



        :root {
            overflow-y: scroll;
            /* Scroll within the project container */
            max-height: calc(100vh - 20px);
            /* Restrict height, leaving space for scrolling */
            --border-light: #99c5f4;
            --border-dark: #ffffff;
            --text-light: #000;
            /* Black for light mode */
            --text-dark: #fff;
            /* White for dark mode */
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(255, 255, 255, 0.1);
        }

        .sidebar {
            width: 280px;
            border: 4px solid white;
            /* Default white border */
            transition: border-color 0.3s ease;
        }

        /* Default Light Mode Styles */
        [data-bs-theme="light"] #projects {

            border: 2px solid var(--border-light);
            color: var(--text-light);
            background-color: transparent;
            box-shadow: 0 4px 6px var(--shadow-light);
            border-color: black;
            /* Black border in light mode */
        }



        /* Dark Mode Styles */
        [data-bs-theme="dark"] #projects {
            border: 2px solid var(--border-dark);
            color: var(--text-dark);
            background-color: transparent;
            box-shadow: 0 4px 6px var(--shadow-dark);
            border-color: white;

            /* White border in dark mode */
        }

        /* Auto Mode (Optional) */
        [data-bs-theme="auto"] #projects {
            border: 2px solid var(--border-light);
            /* Defaults to light mode initially */
            color: var(--text-light);
            box-shadow: 0 4px 6px var(--shadow-light);
        }
    </style>
@endsection

@section('content')
    @include('Shared.loader')
    <div id="projects" class="m-5 p-5 w-100 mx-auto shadow rounded">
        <h2>Section Data</h2>
        <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            @include('Backend.shared.section-translation', ['settings' => $settings])

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

            @include('Backend.Shared.form-actions')
        </form>
    </div>
    <div id="projects" class="m-5 p-5 w-100 mx-auto shadow rounded">
        <h2>Project Data</h2>
        {{-- Create Project Button --}}
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success mb-3">Create Project</a>
        <!-- Table displaying Projects information -->
        <table id="projectsTable" class="table content table-bordered" style="display:none;">
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
    <!-- JavaScript for Form Validation -->
    <script>
        $(document).ready(function() {
            $('.loader').show(); // Show the loader

            // Initialize DataTable
            const table = $('#projectsTable').DataTable({
                scrollX: true,
                fixedColumns: true,
                order: [
                    [1, 'asc']
                ] // Default order by the second column (Project Name)
            });

            const toggle = $('#toggle');
            const toggleStatus = $('#toggle-status');

            // Once the window is fully loaded, hide the loader and show the content
            $(window).on('load', function() {
                // Show the loader when the page starts loading
                $('.loader').show();

                // Set a 1.5-second delay before hiding the loader and showing the content
                setTimeout(function() {
                    $('#loaderWrapper').hide();
                    $('.content').fadeIn(); // Show the main content
                }, 1500); // 1500 milliseconds = 1.5 seconds
            });


            // When checkbox is toggled
            toggle.change(function() {
                const status = toggle.is(':checked') ? 'Show' : 'Hidden';
                toggleStatus.text(status === 'Show' ? 'Show' : 'Hidden'); // Update the status text

                // Send the new status via AJAX
                $.ajax({
                    url: '{{ route('update.form.status', ['form' => 'projects', 'status']) }}', // Update with the actual route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        status: status, // Send the status (show/hidden)
                        form: 'projects'
                    },
                    success: function(response) {
                        // apply success toaster
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('Error updating status', error);
                        window.location.reload();
                    }
                });
            });

            // Checkbox selection handling
            $('#projectsTable').on('click', 'input.project-checkbox', function() {
                const row = $(this).closest('tr');
                if (this.checked) {
                    table.rows(row).select();
                } else {
                    table.rows(row).deselect();
                }
            });
            // Set initial status text based on checkbox state
            toggleStatus.text(toggle.is(':checked') ? 'Show' : 'Hidden');
        });
    </script>
@endsection
