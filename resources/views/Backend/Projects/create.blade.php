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
            border: 2px solid white;
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
    <div id="projects" class="m-5 p-5 w-75 mx-auto shadow rounded">
        <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <!-- Project Name -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="project_name_en" class="form-label">Project Name (EN)</label>
                    <input type="text" class="form-control" name="name_en" id="name_en"
                        placeholder="Enter Project Name in English" />
                </div>
                <div class="col-md-6 text-end">
                    <label for="project_name_ar" class="form-label"> (AR) اسم المشروع </label>
                    <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="أدخل اسم المشروع"
                        dir="rtl" />
                </div>
            </div>

            <!-- Project Description -->
            <div class="mb-4 row align-items-center">
                <div class="col-md-6 text-start">
                    <label for="description_en" class="form-label">Description (EN)</label>
                    <textarea class="form-control" name="description_en" id="description_en" rows="3"
                        placeholder="Enter Project Description in English"></textarea>
                </div>
                <div class="col-md-6 text-end">
                    <label for="description_ar" class="form-label"> (AR) الوصف </label>
                    <textarea class="form-control" name="description_ar" id="description_ar" rows="3" placeholder="أدخل وصف المشروع"
                        dir="rtl"></textarea>
                </div>
            </div>

            <!-- image Upload -->
            <div class="mb-4">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" />
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-success">Create Project</button>
                <a href="{{ route('admin.projects') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>


@endsection


@section('js')
    <script></script>
    <script>
        const table = new DataTable('#example');

        table.on('click', 'tbody tr', function(e) {
            e.currentTarget.classList.toggle('selected');
        });

        document.querySelector('#button').addEventListener('click', function() {
            alert(table.rows('.selected').data().length + ' row(s) selected');
        });
    </script>
@endsection
