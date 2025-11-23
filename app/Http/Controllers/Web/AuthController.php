<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    public function login(LoginRequest $request)
    {
        AuthService::make()->login(
            email: $request->email,
            password: $request->password
        );

        return redirect()->route('tickets.index');
    }

    public function logout()
    {
        AuthService::make()->logout();
        return redirect()->route('login');
    }
}
