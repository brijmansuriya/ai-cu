<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\DataTables\AdminsDataTable;
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

    public function getData(AdminsDataTable $dataTable): JsonResponse
    {
        return $dataTable->ajax();
    }

    public function create(): View
    {
        return view('admin.admins.create');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'status' => 'boolean'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = $request->status ?? true;

        Admin::create($validated);

        return response()->json(['message' => 'Admin created successfully']);
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8',
            'status' => 'boolean'
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $validated['status'] = $request->status ?? $admin->status;

        $admin->update($validated);

        return response()->json(['message' => 'Admin updated successfully']);
    }

    public function destroy(Admin $admin): JsonResponse
    {
        if ($admin->id === auth()->id()) {
            return response()->json(['message' => 'You cannot delete your own account'], 403);
        }

        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully']);
    }

    public function toggleStatus(Admin $admin): JsonResponse
    {
        if ($admin->id === auth()->id()) {
            return response()->json(['message' => 'You cannot change your own status'], 403);
        }

        $admin->status = !$admin->status;
        $admin->save();

        return response()->json(['message' => 'Admin status updated successfully']);
    }
}