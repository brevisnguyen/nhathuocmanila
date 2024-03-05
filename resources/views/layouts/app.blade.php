<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ is_null($title) ? config('app.name') : $title.' - '.config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://kit.fontawesome.com/fdd48f8ac1.js" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased font-nunito scroll-smooth">
        <livewire:header/>
        {{ $slot }}
        <x-toaster-hub />
        <livewire:footer />
        @livewireScripts
    </body>
</html>
