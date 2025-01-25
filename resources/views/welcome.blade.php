@extends('layouts.web')

@section('title', 'Welcome')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to {{ config('app.name') }}</h1>
    <p class="text-xl text-gray-600 mb-8">Your one-stop solution for everything you need.</p>
    
    <div class="grid md:grid-cols-2 gap-8 mt-12">
        <!-- User Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">User Area</h2>
            <p class="text-gray-600 mb-4">Access your personal dashboard and manage your account.</p>
            <div class="space-y-4">
                @guest
                    <a href="{{ route('login') }}" 
                        class="block w-full bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600">
                        User Login
                    </a>
                    <a href="{{ route('register') }}" 
                        class="block w-full bg-green-500 text-white text-center py-2 rounded hover:bg-green-600">
                        User Register
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" 
                        class="block w-full bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600">
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>

        <!-- Admin Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Admin Area</h2>
            <p class="text-gray-600 mb-4">Manage your website and users from the admin panel.</p>
            <div class="space-y-4">
                @guest('admin')
                    <a href="{{ route('admin.login') }}" 
                        class="block w-full bg-purple-500 text-white text-center py-2 rounded hover:bg-purple-600">
                        Admin Login
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" 
                        class="block w-full bg-purple-500 text-white text-center py-2 rounded hover:bg-purple-600">
                        Go to Admin Panel
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
