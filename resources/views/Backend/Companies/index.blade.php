@extends('Backend.Shared.layout')

@section('title', 'Companies')

@section('content')
    <div id="companies-tables" class="themed-box mt-4">
        <h2>Companies Data</h2>
        {{-- create button --}}
        <a href="{{ route('admin.companies.create') }}" class="btn btn-success mb-3">Create Company</a>
        <!-- Table displaying Companies information -->
        <table id="companiesTable" class="table content table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $index => $company)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $company['company_name'] }}</td>
                        <td>{{ $company['email'] }}</td>
                        <td>
                            <!-- Add any actions here -->
                            <a href="{{ route('admin.companies.edit', $company['company_name']) }}"
                                class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.companies.destroy', $company['company_name']) }}" method="POST"
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
            // Initialize DataTable for companiesTable
            $('#companiesTable').DataTable();
        });
    </script>
@endsection
