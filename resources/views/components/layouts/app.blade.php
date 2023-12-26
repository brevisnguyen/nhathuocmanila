<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/fdd48f8ac1.js" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased font-nunito">
        <livewire:header/>
        {{ $slot }}
        <livewire:footer />
    </body>
</html>
