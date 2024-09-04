<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased max-h-screen">
    <x-navbar-layout />
    <div class="m-40 flex-grow flex flex-col lg:justify-center items-center">

        <div
            class="lg:h-auto lg:w-auto m-8 flex flex-col lg:justify-center items-center pt-28 px-28 py-16 bg-amber-100 shadow-md overflow-hidden sm:rounded-lg">

            <div class="w-full flex justify-start">
                <x-menu-layout />
            </div>

            {{ $slot }}
        </div>
        @include('sweetalert::alert')
    </div>
</body>



<div class="w-full  mt-32">
    <x-footer-layout />
</div>
<script src="//unpkg.com/alpinejs" defer></script>

</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
