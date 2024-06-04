<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="fb:app_id" content="{{ get_seo_setting('social_facebook_app_id') }}" />
        <link rel="icon" href="{{ getFavicon() }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ getFavicon() }}" type="image/x-icon">

        {!! SEO::generate() !!}

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://kit.fontawesome.com/fdd48f8ac1.js" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased font-nunito scroll-smooth scrollbar">
        <livewire:header/>
        {{ $slot }}
        <x-toaster-hub />
        <livewire:footer />
        @livewireScripts
    </body>
</html>
