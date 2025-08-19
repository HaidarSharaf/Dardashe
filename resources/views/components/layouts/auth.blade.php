<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" bg-gradient-to-br from-gray-700 via-gray-800 to-blue-900 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col" x-data x-on:click="$dispatch('search:clear-text')">

<header class="w-full lg:max-w-6xl md:max-w-3xl sm:max-w-[600px] max-w-[450px] text-sm mb-2 not-has-[nav]:hidden">

</header>

<div
    class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 my-10"
>
    <main
        class="flex w-full flex-col-reverse justify-center items-center lg:max-w-5xl md:max-w-xl sm:max-w-lg max-w-md lg:flex-row"
    >
        {{ $slot }}
    </main>

</div>


</body>
</html>
