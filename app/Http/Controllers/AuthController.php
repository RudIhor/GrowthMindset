<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\StoreLoginDTO;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param StoreLoginDTO $loginDTO
     * @return JsonResponse
     */
    public function login(StoreLoginDTO $loginDTO): JsonResponse
    {
        if (!$token = auth()->attempt($loginDTO->toArray())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated',
            ], 401);
        }
        $user = Auth::user();

        return $this->respondWithUserAndToken($user, (string)$token);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        /** @phpstan-ignore-next-line  */
        return $this->respondWithUserAndToken(auth()->user(), auth()->refresh('main'));
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param User|Authenticatable|null $user
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithUserAndToken(User|Authenticatable|null $user, string $token): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
            'type' => 'bearer',
        ]);
    }
}
