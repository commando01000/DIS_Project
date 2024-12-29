{{-- Create User Modal --}}

<div class="modal fade" id="{{ $div_id }}" tabindex="-1" aria-labelledby="{{ $div_id }}_Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $div_id }}_Label">{{ $Name_of_modal }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateUserForm" method="POST" action="{{ route('admin.users.update') }}">
                    @csrf
                    <div class="modal-body">
                        {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                        <input type="hidden" id="user_id" name="user_id" value="">

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
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="{{ $div_id }}" tabindex="-1" aria-labelledby="{{ $div_id }}_Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $div_id }}_Label">{{ $Name_of_modal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userUpdateForm" method="POST" action="{{ route('admin.users.update') }}">
                @csrf
                @method('POST')
                <input type="hidden" id="user_id" name="user_id" value="">
                <div class="form-group">
                    <label for="user_name">Name</label>
                    <input type="text" name="name" id="user_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="email" name="email" id="user_email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="is_admin_checkbox">Is Admin</label>
                    <input type="checkbox" id="is_admin_checkbox">
                    <input type="hidden" name="is_admin" id="is_admin" value="0">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>

        </div>
    </div>

</div> --}}
{{-- @section('scripts')
    <script>
        // Function to open the modal with specific index and populate fields
        function openEditModal() {
            var myModal = new bootstrap.Modal(document.getElementById({{ $div_id }}));
            myModal.show();
        }
    </script>
@endsection --}}
