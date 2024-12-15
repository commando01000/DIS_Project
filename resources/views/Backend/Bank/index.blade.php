@extends('Backend.Shared.layout')

@section('title', 'Banks Data')

@section('content')
    <div id="clients" class="themed-box">
        @include('Shared.loader')
        <h2>Clients</h2>

        <form action="{{ route('update.settings.clients') }}" method="POST">
            @csrf
            <div class="mb-5 pb-5">
                @include('Backend.shared.section-translation', ['settings' => $settings])

                @include('Backend.Shared.form-actions')
            </div>
        </form>
    </div>
    <div class="themed-box">
        <h2>Client Data</h2>
        {{-- Create Bank Button --}}
        <a href="{{ route('admin.client.create') }}" class="btn btn-success mb-3">Create Client</a>

        <!-- Table displaying banks information -->
        <table id="banksTable" class="table content table-bordered" style="display:none;">
            <thead>
                <tr>
                    {{-- <th>Select</th> --}}
                    <th>Client Name</th>
                    <th>Client Image</th>
                    <th>Modules</th>
                    <th>Contract Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each bank and display its details -->
                @foreach ($banks as $bank)
                    <tr>
                        <!-- Checkbox for selection -->
                        {{-- <td>
                            <input type="checkbox" class="bank-checkbox" data-id="{{ $bank->id }}">
                        </td> --}}
                        <!-- Display bank name -->
                        <td>{{ $bank->name[app()->getLocale()] }}</td>
                        <td>
                            <img class="dt-image" src="{{ asset($bank->image) }}"
                                alt="{{ $bank->name[app()->getLocale()] }}" class="img-fluid" />
                        </td>
                        <td>
                            <!-- Display the associated modules -->
                            @foreach ($bank->modules as $module)
                                <span>{{ $module->name }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $bank->contract_date }}</td>
                        <td>
                            <!-- Edit and delete actions for each bank -->
                            <a href="{{ route('admin.client.edit', $bank->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.client.destroy', $bank->id) }}" method="POST"
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

@section('js')
<script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script>
<!-- JavaScript for Form Validation -->

<script>
    $(document).ready(function() {
        $('.loader').show();
    });

    // Once the window is fully loaded, hide the loader and show the content
    $(window).on('load', function() {
        // Show the loader when the page starts loading
        $('.loader').show();

        // Set a 1.5-second delay before hiding the loader and showing the content
        setTimeout(function() {
            $('#loaderWrapper').hide();
            $('.content').fadeIn(); // Show the main content
        }, 1500); // 1500 milliseconds = 1.5 seconds

        // Call the initializer toggle function
        $(document).ready(function() {
            let baseUrl = "{{ route('update.form.status', ['key' => ':key', 'form' => ':form', 'status' => ':status']) }}";
        token = '{{ csrf_token() }}';
        // Call the initializeTable function
            initializeTable({
                baseUrl: baseUrl,
                csrf_token: token,
                formName: 'clients'
            });
            initializer({
                baseUrl: baseUrl,
                csrf_token: token,
                key: 'clients',
                formName: 'clients'
            });
        });
    });
</script>
@endsection
