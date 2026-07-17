<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Handle user registration.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        return $user;
    }
}
