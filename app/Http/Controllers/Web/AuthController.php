<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController
{
    public function __construct(
        public AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        $this->authService->login(
            email: $request->email,
            password: $request->password
        );

        return redirect()->route('tickets.index');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('login');
    }
}
