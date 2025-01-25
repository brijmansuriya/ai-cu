<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    /**
     * Display a test response
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Test controller is working',
            'status' => 'success'
        ]);
    }

    /**
     * Test POST request handling
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'POST request received',
            'data' => $request->all()
        ]);
    }

    /**
     * Test request parameters
     */
    public function show($id): JsonResponse
    {
        return response()->json([
            'message' => 'GET request with parameter',
            'id' => $id
        ]);
    }

    /**
     * Test error handling
     */
    public function testError(): JsonResponse
    {
        return response()->json([
            'message' => 'Error test',
            'error' => 'This is a test error response'
        ], 400);
    }
}
