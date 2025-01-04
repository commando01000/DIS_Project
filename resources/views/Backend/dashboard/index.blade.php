@extends('Backend.Shared.layout')
@section('title', 'Dashboard')
@section('content')
    <div id="logo-img"
        class="w-75 text-center d-flex align-items-center mt-5 justify-content-center animate__animated animate__lightSpeedInRight">
        <img style="background-color: white; border-radius: 20%; width: 30%; hight: 30%;"
            src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />
    </div>
    
@endsection

@section('scripts')
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
@endsection
