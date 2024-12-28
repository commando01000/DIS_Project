    <div id="users-tables" class="themed-box mt-4">
        <h2>User Data</h2>
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

    {{-- @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable for usersTable
                initializeTable({
                    formName: 'users'
                });

                // Initialize the toggle for users visibility
                // initializer({
                //     baseUrl: "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}",
                //     csrf_token: '{{ csrf_token() }}',
                //     formName: 'usersTable'
                // });
            });
        </script>
    @endsection --}}
