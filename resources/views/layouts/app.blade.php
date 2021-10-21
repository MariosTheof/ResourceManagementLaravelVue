<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Management Application</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>

<main>
    <div class="topnav mb-5">
        @if (Request::is('admin*'))
            <a class="active" href="/visitor">Switch to Visitor</a>
        @else
            <a class="active" href="/admin">Switch to Admin</a>
        @endif

    </div>
    @yield('content')
</main>

</body>
<style>
    .topnav {
        background-color: #F0F4EF;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        color: #8A2BE2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #8A2BE2;
        color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: #8A2BE2;
        color: white;
    }
</style>
<script src="{{ mix('/js/app.js') }}"></script>
</html>
