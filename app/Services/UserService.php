<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * Handle incoming user registration requests.
     *
     * @param  array  $userData  The validated registration payload.
     * @return User
     */
    public function signUp(array $userData): User
    {
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        Log::info('what IS user', [$user]);
        return $user;
    }
}