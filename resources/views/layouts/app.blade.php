<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Panel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    @if(Session::has('success'))
        <div class="fixed top-4 right-4 rounded-lg shadow-md bg-blue-600 text-white px-5 py-3" id="message">
            <p>{{session('success')}}</p>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('message').style.display = 'none';
            }, 2000);
        </script>
@endif
        <div class="flex bg-gray-100 shadow">
            <div class="w-64 h-screen bg-white shadow-md">
                <!-- Admin Logo -->
                <div class="p-4 bg-gray-100">
                    <img src="{{ asset('img/adminlogo.png') }}" alt="Admin Logo" class="w-3/4 mx-auto p-2 bg-white rounded-lg shadow-md">
                </div>
            
                <!-- Navigation Menu -->
                <nav class="mt-8">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="block text-lg font-semibold text-gray-700 hover:text-white hover:bg-amber-500 transition-colors duration-300 p-3 rounded-md mx-3">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cars.index') }}" class="block text-lg font-semibold text-gray-700 hover:text-white hover:bg-amber-500 transition-colors duration-300 p-3 rounded-md mx-3">
                                Cars
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('useradmin.index') }}" class="block text-lg font-semibold text-gray-700 hover:text-white hover:bg-amber-500 transition-colors duration-300 p-3 rounded-md mx-3">
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notification') }}" class="block text-lg font-semibold text-gray-700 hover:text-white hover:bg-amber-500 transition-colors duration-300 p-3 rounded-md mx-3">
                                Notification
                            </a>
                        </li>
                        <li>
                            <!-- Logout -->
                            <form id="logout-form" method="post" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block text-lg font-semibold text-gray-700 hover:text-white hover:bg-amber-500 transition-colors duration-300 p-3 rounded-md mx-3">
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="p-4 flex-1">
                @yield('content')
            </div>
        </div>
    </body>
</html>