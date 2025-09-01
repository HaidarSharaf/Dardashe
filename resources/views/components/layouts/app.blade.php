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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
</head>
<body
    class="bg-gradient-to-br p-0 m-0 from-gray-700 via-gray-400 to-blue-900 flex items-center lg:justify-center min-h-screen flex-col"
    x-data="{ loading: true }"
    x-init="
        if (!window.alreadyLoaded) {
            window.alreadyLoaded = true;
            const start = Date.now();
            window.addEventListener('load', () => {
                const elapsed = Date.now() - start;
                const remaining = 2000 - elapsed;
                setTimeout(() => loading = false, remaining > 0 ? remaining : 0);
            });
        } else {
            loading = false;
        }
    "
>

<div
    x-show="loading"
    x-transition.opacity.duration.500ms
    class="fixed inset-0 z-50 flex items-center justify-center"
>
    <img src="{{ asset('/images/dardashe.png') }}" class="h-16 w-auto animate-pulse" alt="Loading...">
</div>

<div
    x-show="!loading"
    x-transition.opacity.duration.500ms
    class="flex items-start justify-center w-full min-h-screen transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0"
>
    <div
        class="fixed inset-y-0 left-0 flex-4/5 z-40 transform transition-transform lg:static lg:translate-x-0 lg:flex-1/3"
    >
        <livewire:chats />
    </div>

    <main
        class="flex-1 flex flex-col lg:flex-2/3 h-screen bg-white shadow-2xl rounded-lg lg:mx-0"
    >
        {{ $slot }}
    </main>

</div>

        @livewireScripts

           


</body>
</html>
