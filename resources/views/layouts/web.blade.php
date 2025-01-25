<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-black text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">{{ config('app.name') }}</a>
            <div class="space-x-4">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                    <a href="{{ route('admin.login') }}" class="hover:text-gray-300">Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container mx-auto mt-6 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white mt-12 py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 