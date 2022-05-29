<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>
    <!-- links -->
    <link rel="icon" href="{{ asset('images/main/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- links -->

</head>

<body class = "admins-bg">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <!-- scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-1.10.1.min.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"> </script>
    <script type="text/javascript">
        window.User = {!! json_encode(optional(auth()->user())->only('id', 'email', 'name' , 'role')) !!}
    </script>
    <!-- scripts -->
</body>

</html>
