<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function signUp(StoreUserRequest $request, UserService $userService): JsonResponse
    {
        try{
            Log::info("User creation: Beginning execution.");

            $userData = $request->validated();
            $user = $userService->signUp($userData);

            $returnData = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email
            ];
            $message = "User successfully created with id {$user->id}";

            return $this->jsonResponse(true, $returnData, $message, 201);
        } catch (Throwable $e) {
            Log::error('Registration failed: ' . $e->getMessage(), ['exception' => $e]);

            return $this->jsonResponse(
                false,
                null,
                'An unexpected error occurred during registration.',
                500
            );
        }
    }
}