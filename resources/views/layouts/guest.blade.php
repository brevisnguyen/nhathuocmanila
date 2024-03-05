<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ is_null($title) ? config('app.name') : $title.' - '.config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://kit.fontawesome.com/fdd48f8ac1.js" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased font-nunito">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" wire:navigate>
                    <img class="w-2/5 md:w-40 mx-auto" src="{{ asset('storage/'.app(App\Settings\WebSettings::class)->logo_portrait) }}" alt="{{ config('app.name') }}">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
