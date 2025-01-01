@extends('Backend.Shared.layout')

@section('title', 'Users Data')

@section('content')
    @include('Shared.loader')
    <div id="users-tables" class="themed-box mt-4">
        <h2>User Data</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_user"
            onclick="openEditModal('user_create')">
            Create User
        </button>
        {{-- Create User Modal --}}
        @include('Backend.Users.modal', [
            'title' => 'Create User',
            'route' => route('admin.users.store'),
            'type' => '', // Use 'create' for the modal type
            'modal_name' => 'user_create',
            'form_name' => 'user_create',
        ])

        {{-- Edit User Modal --}}
        @include('Backend.Users.modal', [
            'title' => 'Edit User',
            'route' => route('admin.users.update'),
            'type' => 'update', // Use 'update' for the modal type
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
                @foreach ($users as $index => $user)
                    {{-- {{dd($index);}} --}}
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
                                    data-bs-target="#user_edit" data-user-id="{{ $user->id }}"
                                    data-modal-name="user_edit" id="user_btn_edit">
                                    Edit
                                </button>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit" data-user-id="{{ $user->id }}"
                                    data-modal-name="user_edit"
                                    onclick="populateEditModal({{ json_encode($user) }}, 'user_edit', {{ $index }})">
                                    Edit
                                </button> --}}


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
                console.log('Checkbox checked: value = 0');
                hiddenInput.value = 1; // Set hidden input value to 1
            } else {
                console.log('Checkbox unchecked: value = 1');
                hiddenInput.value = 0; // Set hidden input value to 0
            }
        });

        function openEditModal(modalName) {
            // Show the modal
            const modalElement = document.getElementById(modalName);
            const editModal = new bootstrap.Modal(modalElement);
            editModal.show();
        }

        // function populateEditModal(user, modalName, index = null) {
        //     if (!user) return;
        //     console.log(user)
        //     console.log(user.id)
        //     console.log(index)
        //     document.getElementById('index').value = index || '';
        //     document.getElementById('user_id').value = user.id || '';
        //     document.getElementById('name').value = user.name || 'Enter Your Name';
        //     document.getElementById('password').value = user.password || 'Enter Your Password';
        //     document.getElementById('email').value = user.email || 'Enter Your Email';

        //     // Photo Preview
        //     const photoPreview = document.getElementById('photoPreview');
        //     if (user.photo) {
        //         photoPreview.src = '/' + user.photo; // Adjust path if necessary
        //         photoPreview.style.display = 'block';
        //     } else {
        //         photoPreview.style.display = 'none';
        //     }

        //     // Admin Checkbox
        //     document.getElementById('is_admin_checkbox').checked = user.is_admin === 1;
        //     openEditModal(modalName)

        // }
        // function populateEditModal(user, modalName, index = null) {
        //     if (!user) return;

        //     // Populate hidden inputs
        //     document.getElementById('index').value = index || '';
        //     document.getElementById('user_id').value = user.id || '';

        //     // Populate text inputs
        //     document.getElementById('name').value = user.name || '';
        //     document.getElementById('password').value = ''; // Never pre-fill password
        //     document.getElementById('email').value = user.email || '';

        //     // Display photo preview
        //     const photoPreview = document.getElementById('photoPreview');
        //     if (user.photo) {
        //         photoPreview.src = '/' + user.photo; // Adjust as per your file structure
        //         photoPreview.style.display = 'block';
        //     } else {
        //         photoPreview.style.display = 'none';
        //     }

        //     // Check admin checkbox
        //     document.getElementById('is_admin_checkbox').checked = user.is_admin === 1;

        //     // Show the modal
        //     const modalElement = document.getElementById(modalName);
        //     const modalInstance = new bootstrap.Modal(modalElement);
        //     modalInstance.show();
        // }
        // $(document).ready(function() {
        //     // When the Edit button is clicked
        //     $(document).on('click', '#user_btn_edit', function(e) {
        //         e.preventDefault(); // Prevent default form submission or link click

        //         var userId = $(this).data('user-id'); // Get the user ID from the button's data attribute
        //         var modalName = $(this).data(
        //         'modal-name'); // Get the modal name from the button's data attribute

        //         // AJAX request to fetch the user data
        //         $.ajax({
        //             url: '/admin/users/' + userId + '/edit', // Replace with the correct edit route
        //             type: 'GET',
        //             success: function(response) {
        //                 if (response.success) {
        //                     // Populate modal fields with user data
        //                     $('#' + modalName + ' #name').val(response.name);
        //                     $('#' + modalName + ' #email').val(response.email);
        //                     $('#' + modalName + ' #photo').val(response
        //                     .photo); // If photo URL needs to be shown
        //                     $('#' + modalName + ' #is_admin_checkbox').prop('checked', response
        //                         .is_admin == 1);

        //                     // If there is a photo, display it in the preview
        //                     if (response.photo) {
        //                         $('#' + modalName + ' #photoPreview').attr('src', response
        //                             .photo).show();
        //                     }

        //                     // Open the modal
        //                     var modalElement = new bootstrap.Modal(document.getElementById(
        //                         modalName));
        //                     modalElement.show();
        //                 } else {
        //                     alert('Error fetching user data');
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error fetching user data:', error);
        //             }
        //         });
        //     });
        // });
        $(document).ready(function() {
            // When the Edit button is clicked
            $(document).on('click', '#user_btn_edit', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                var modalName = $(this).data('modal-name');

                $.ajax({
                    url: '/admin/users/' + userId + '/edit',
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Reset form and populate fields
                            $('#' + modalName + ' form')[0].reset();
                            $('#' + modalName + ' #user_id').val(userId);
                            $('#' + modalName + ' #name').val(response.name);
                            $('#' + modalName + ' #email').val(response.email);
                            $('#' + modalName + ' #password').val('');

                            // Handle admin checkbox
                            var checkbox = $('#' + modalName + ' #is_admin_checkbox');
                            checkbox.prop('checked', response.is_admin == 1);

                            // Add event listener to checkbox
                            checkbox.off('change').on('change', function() {
                                const hiddenInput = $(this).siblings(
                                    'input[name="is_admin"]');
                                hiddenInput.val(this.checked ? 1 : 0);
                            });

                            // Handle photo preview
                            if (response.photo) {
                                $('#' + modalName + ' #photoPreview')
                                    .attr('src', response.photo)
                                    .show();
                            } else {
                                $('#' + modalName + ' #photoPreview').hide();
                            }

                            // Show modal
                            var modalElement = new bootstrap.Modal(document.getElementById(
                                modalName));
                            modalElement.show();
                        } else {
                            alert('Error fetching user data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching user data:', error);
                    }
                });
            });

            // Initialize DataTable
            initializeTable({
                formName: 'usersTable'
            });
        });
    </script>
@endsection
