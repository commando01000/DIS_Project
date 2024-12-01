<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $direction ?? 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- <script src="{{ asset('js/mdb.min.js') }}"></script> --}}
    <title>@yield('title', 'Admin Dashboard')</title>
</head>

<body>
    <!-- Main Navigation -->
    <header>
        @include('Backend.Shared.sidebar') <!-- Include Sidebar -->
        @include('Backend.Shared.nav') <!-- Include Navbar -->
    </header>

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>

    <!-- Include Scripts (optional) -->
</body>

</html>

