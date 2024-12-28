@extends('Backend.Shared.layout')

@section('title', 'Users Data')

@section('content')

    <div id="users-tables" class="themed-box mt-4">
        <h2>User Data</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_user"
            onclick="openEditModal()">
            Create User
        </button>
        <div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="create_userLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="create_userLabel">Swiper Data Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @php
                        $swipers = Settings::getSettingValue('swiper')['swiper-data'];

                    @endphp
                    <form id="create_user" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="" id="name" name="name"
                                    placeholder="Enter Your Name" required>
                            </div>

                            <!-- Mail Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Mail</label>
                                <input type="mail" class="form-control" value="" id="email" name="email"
                                    placeholder="Enter Your Mail" required>
                            </div>
                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter a new password">
                            </div>

                            <!-- Re-enter Password Field -->
                            <div class="mb-3">
                                <label for="userRePassword" class="form-label">Re-enter Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Re-enter the password">
                            </div>

                            {{-- Is Admin --}}
                            <div class="mb-3">
                                <!-- Hidden input for default value -->
                                <input type="hidden" name="is_admin" value="0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_admin_checkbox">
                                    <label class="form-check-label" for="is_admin_checkbox">
                                        User is Admin
                                    </label>
                                </div>
                            </div>




                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">Image</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" onclick="openEditModal()" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
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

    <script>
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
    </script>
    <script>
        // Function to open the modal with specific index and populate fields
        function openEditModal() {
            // Get the swiper data using the passed index
            // Open the modal
            var myModal = new bootstrap.Modal(document.getElementById('create_user'));
            myModal.show();
        }
    </script>
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
        $(document).ready(function() {
            // Initialize DataTable for usersTable
            initializeTable({
                formName: 'users'
            });
        });
    </script>
@endsection
