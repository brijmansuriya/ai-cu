<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\DataTables\AdminsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(AdminsDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.admins.index');
    }

    public function create(): View
    {
        return view('admin.admins.create');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = true;

        Admin::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully.',
            'redirect' => route('admin.admins.index')
        ]);
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Admin updated successfully.',
            'redirect' => route('admin.admins.index')
        ]);
    }

    public function destroy(Admin $admin): JsonResponse
    {
        try {
            $admin->delete();
            return response()->json([
                'success' => true,
                'message' => 'Admin deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting admin.'
            ], 500);
        }
    }

    public function toggleStatus(Admin $admin): JsonResponse
    {
        try {
            $admin->update(['status' => !$admin->status]);
            return response()->json([
                'success' => true,
                'message' => 'Admin status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating admin status.'
            ], 500);
        }
    }
} 