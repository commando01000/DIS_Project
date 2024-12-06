@extends('Backend.Shared.layout')

@section('title', 'Banks Data')

@section('content')
    <div class="container mt-5">
        <h2>Banks Data</h2>
        <!-- Table displaying banks information -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Modules</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each bank and display its details -->
                @foreach ($banks as $bank)
                    <tr>
                        <!-- Display bank name -->
                        <td>{{ $bank->name }}</td>
                        <td>
                            <!-- Display the associated modules -->
                            @foreach ($bank->modules as $module)
                                <span>{{ $module->name }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <!-- Edit and delete actions for each bank -->
                            <a href="{{ route('bank.edit', $bank->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('bank.destroy', $bank->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $banks->links() }}
        </div>
    </div>
@endsection
