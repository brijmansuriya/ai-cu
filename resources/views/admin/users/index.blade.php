@extends('layouts.admin')

@section('title', 'Users Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/custom-datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/datatable-loader.css') }}">
@endpush

@section('content')
<div class="flex flex-col">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Users Management</h2>
            <p class="mt-1 text-sm text-gray-600">Manage and monitor user accounts</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
            class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New User
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="overflow-x-auto">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush