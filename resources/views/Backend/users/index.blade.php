@extends('Backend.Shared.layout')

@section('title', 'Users Data')

@section('content')

    <div id="users-tables" class="themed-box mt-4">
        <h2>User Data</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_user"
            onclick="openEditModal('user_create')">
            Create User
        </button>
        @include('Backend.Users.modal', [
            'title' => 'Create User',
            'route' => route('admin.users.store'),
            'type' => 'create',
            'modal_name' => 'user_create',
            'form_name' => 'user_create',
        ])

        @include('Backend.Users.modal', [
            'title' => 'Edit User',
            'route' => route('admin.users.update', 'id'),
            'type' => 'update',
            'modal_name' => 'user_edit',
            'form_name' => 'user_edit',
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit"
                                    onclick="populateEditModal({{ json_encode($user) }}, 'user_edit')">
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

        function openEditModal(modalName) {
            // Show the modal
            const modalElement = document.getElementById(modalName);
            const editModal = new bootstrap.Modal(modalElement);
            editModal.show();
        }

        function populateEditModal(user, modalName) {
            if (!user) return;
            console.log(user)
            console.log(user.id)
            document.getElementById('user_id').value = user.id || '';
            document.getElementById('name').value = user.name || 'Enter Your Name';
            document.getElementById('password').value = user.password || 'Enter Your Password';
            document.getElementById('email').value = user.email || 'Enter Your Email';

            // Photo Preview
            const photoPreview = document.getElementById('photoPreview');
            if (user.photo) {
                photoPreview.src = '/' + user.photo; // Adjust path if necessary
                photoPreview.style.display = 'block';
            } else {
                photoPreview.style.display = 'none';
            }

            // Admin Checkbox
            document.getElementById('is_admin_checkbox').checked = user.is_admin === 1;
            openEditModal(modalName)

        }
        // Or with jQuery:
        $(document).ready(function() {
            initializeTable({
                formName: 'usersTable'
            });
        });
    </script>
@endsection
