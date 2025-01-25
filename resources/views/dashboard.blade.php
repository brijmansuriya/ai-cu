@extends('layouts.web')

@section('title', 'Dashboard')

@section('content')
<div class="grid md:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Profile</h2>
        <div class="space-y-3">
            <p class="text-gray-600">Name: <span class="font-medium">{{ Auth::user()->name }}</span></p>
            <p class="text-gray-600">Email: <span class="font-medium">{{ Auth::user()->email }}</span></p>
            <p class="text-gray-600">Member since: <span class="font-medium">{{ Auth::user()->created_at->format('M Y') }}</span></p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="space-y-3">
            <a href="#" class="block text-blue-600 hover:text-blue-800">Edit Profile</a>
            <a href="#" class="block text-blue-600 hover:text-blue-800">Change Password</a>
            <a href="#" class="block text-blue-600 hover:text-blue-800">Notifications</a>
        </div>
    </div>

    <!-- Activity -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="space-y-3">
            <p class="text-gray-600">No recent activity</p>
        </div>
    </div>
</div>
@endsection 