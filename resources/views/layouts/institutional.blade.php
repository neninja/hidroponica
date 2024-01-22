<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name'))</title>

        @vite(['resources/sass/institutional.scss', 'resources/js/institutional.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        @yield('content')

        @livewireScripts
    </body>
</html>
