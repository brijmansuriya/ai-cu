@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Overview -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
            <p class="text-3xl font-bold text-purple-600">0</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Active Users</h3>
            <p class="text-3xl font-bold text-purple-600">0</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">New Users (Today)</h3>
            <p class="text-3xl font-bold text-purple-600">0</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Admins</h3>
            <p class="text-3xl font-bold text-purple-600">1</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="p-4 bg-purple-50 rounded-lg">
                <h3 class="font-bold text-purple-900">Manage Users</h3>
                <p class="text-purple-800 mb-4">View and manage user accounts</p>
                <a href="#" class="text-purple-600 hover:text-purple-800">View Users →</a>
            </div>
            <div class="p-4 bg-purple-50 rounded-lg">
                <h3 class="font-bold text-purple-900">System Settings</h3>
                <p class="text-purple-800 mb-4">Configure application settings</p>
                <a href="#" class="text-purple-600 hover:text-purple-800">View Settings →</a>
            </div>
            <div class="p-4 bg-purple-50 rounded-lg">
                <h3 class="font-bold text-purple-900">Reports</h3>
                <p class="text-purple-800 mb-4">View system reports and analytics</p>
                <a href="#" class="text-purple-600 hover:text-purple-800">View Reports →</a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="space-y-4">
            <p class="text-gray-600">No recent activity to display.</p>
        </div>
    </div>
</div>
@endsection 