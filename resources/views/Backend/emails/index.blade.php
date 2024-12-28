@extends('Backend.Shared.layout')

@section('title', 'Emails')

@section('content')
    {{-- <div id="Emails" class="themed-box">
        <h2>Email Settings</h2>
        <form action="{{ route('update.settings.emails') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @include('Backend.shared.section-translation', [
                'settings' => Settings::getSettingValue('emails'),
            ])

            @include('Backend.Shared.form-actions', [
                'settings' => Settings::getSettingValue('emails'),
                'formName' => 'emails',
            ])
        </form>
    </div> --}}

    <div id="emails-tables" class="themed-box mt-4">
        <h2>Email Data</h2>
        <!-- Uncomment the line below if you want a "Create Email" button -->
        <a href="{{ route('admin.emails.create') }}" class="btn btn-success mb-3">Create Email</a>
        <a href="{{ route('mail.config') }}" class="btn btn-warning mb-3">Edit Mail Config</a>

        <!-- Table displaying Emails information -->
        <table id="emailsTable" class="table content table-bordered">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Sent Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emails as $email)
                    <tr>
                        <td>
                            <input type="checkbox" name="emails-checkbox" value="{{ $email->id }}">
                        </td>
                        <td>
                            {{ implode(', ', $email->recipients->pluck('email')->toArray()) }}
                        </td>
                        <td>{{ $email->subject }}</td>
                        <td>{{ ucfirst($email->status) }}</td>
                        <td>{{ $email->date ? $email->date->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        <td>
                            {{-- show --}}
                            <a href="{{ route('admin.emails.show', $email->id) }}" class="btn btn-info">Show</a>
                            <form action="{{ route('admin.emails.destroy', $email->id) }}" method="POST"
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
    <script>
        $(document).ready(function() {
            // Initialize DataTable for emailsTable
            initializeTable({
                formName: 'emails'
            });

            // Initialize the toggle for emails visibility
            initializer({
                baseUrl: "{{ route('update.form.status', ['form' => ':form', 'status' => ':status']) }}",
                csrf_token: '{{ csrf_token() }}',
                formName: 'emails'
            });
        });
    </script>
@endsection
