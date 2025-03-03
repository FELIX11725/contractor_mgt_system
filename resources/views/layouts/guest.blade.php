<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles        

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>         
    </head>
    <body class="font-inter antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400">

        <main class="bg-white dark:bg-gray-900">

            <!-- Content -->
            <div class="w-full">

                <div class="min-h-[100dvh] h-full">

                    <!-- Header -->
                    <div>
                        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                            <!-- Logo -->
                            <a class="block flex items-center space-x-2" href="{{ route('dashboard') }}">
                                {{-- <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                    <path d="M4 4h18a2 2 0 0 1 2 2v20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm18 2H4v20h18V6zm-6 12H6v2h10v-2zm0-4H6v2h10v-2zm0-4H6v2h10v-2zM25 8h3a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2h-3v2h-2v-2h-5v-2h5v-5h-5v-2h5v-5h-5v-2h5V8h2v2z" />
                                </svg> --}}
                                {{-- <span class="text-violet-500 font-medium">Contractor MS</span> --}}
                                <img src="{{ asset('images/Contractor logo-2.png') }}" 
                                alt="Logo" 
                                class="h-24 w-auto md:h-28 lg:h-32 mt-4 md:mt-6">
                            </a>
                        </div>
                    </div>

                    <div class="w-full max-w-3xl mx-auto px-4 py-8">
                        {{ $slot }}
                    </div>

                </div>

            </div>

            </div>

        </main>   

        @livewireScriptConfig
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </body>
</html>
