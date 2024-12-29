@extends('Backend.Shared.layout')

@section('title', 'Users Data')

@section('content')

    <div id="users-tables" class="themed-box mt-4">
        <h2>User Data</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_user"
            onclick="openEditModal()">
            Create User
        </button>

        @include('Backend.users.modal', [
            'route' => route('admin.users.store'),
            'Name_of_modal' => 'Create User',
            'div_id' => 'create_user',
            'type' => '',
        ])
        @include('Backend.users.modal', [
            'route' => route('admin.users.update'),
            'Name_of_modal' => 'Update User',
            'div_id' => 'user_edit',
            'type' => '',
        ])

        <!-- Table displaying Users information -->
        <table id="usersTable" class="table content table-bordered">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user != auth()->user())
                        <tr>
                            <td>
                                @if ($user->photo)
                                    <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}'s photo" width="50"
                                        height="50" class="rounded-circle">
                                @else
                                    <span>No Photo</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">Show</a>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit" onclick="openEditModal()">
                                    Edit
                                </button> --}}

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit"
                                    onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->photo }}', {{ $user->is_admin }})">
                                    Edit
                                </button>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    {{-- @yield('modal-js') --}}
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

        // Add event listener to the checkbox
        document.getElementById('is_admin_checkbox').addEventListener('change', function() {
            const hiddenInput = document.querySelector('input[name="is_admin"]');
            if (this.checked) {
                console.log('Checkbox checked: value = 1');
                hiddenInput.value = 1; // Set hidden input value to 1
            } else {
                console.log('Checkbox unchecked: value = 0');
                hiddenInput.value = 0; // Set hidden input value to 0
            }
        });


        // Place your `openEditModal` function or other scripts here
        document.addEventListener('DOMContentLoaded', () => {
            function openEditModal(user_id, name, email, photo, isAdmin) {
                // Set user ID
                document.getElementById('user_id').value = user_id;
                console.log(user_id);

                // Populate other fields
                document.getElementById('name').value = name;
                document.getElementById('email').value = email;

                // // Handle photo preview
                // if (photo) {
                //     document.getElementById('photoPreview').src = '/' + photo; // Adjust the path if needed
                //     document.getElementById('photoPreview').style.display = 'block';
                // } else {
                //     document.getElementById('photoPreview').style.display = 'none';
                // }

                // Set the checkbox for is_admin
                document.getElementById('is_admin_checkbox').checked = isAdmin === 0;

                // Show the modal
                const modalElement = document.getElementById('user_edit');
                if (modalElement) {
                    const editModal = new bootstrap.Modal(modalElement);
                    editModal.show();
                } else {
                    console.error('Modal element not found!');
                }
            }
        });
        $(document).ready(function() {
            $('#usersTable').DataTable();
            initializeTable({
                formName: 'usersTable'
            });
        });
        initializer({
            baseUrl: baseUrl,
            csrf_token: token,
            key: 'users',
            formName: 'users'
        });
    </script>
@endsection
