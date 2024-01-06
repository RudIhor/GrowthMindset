<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'message' => 'Server is live!',
            'status' => 'success',
        ]);
    }
}
