<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService extends Service
{
    public function __construct(
        protected AuthRepository $authRepository
    ) {}

    /**
     * @throws ValidationException
     */
    public function login(string $email, string $password): void
    {
        $user = $this->authRepository->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        if (! $user->hasAnyRole(['admin', 'manager'])) {
            throw ValidationException::withMessages([
                'email' => ['You can\t access to dashboard.'],
            ]);
        }

        Auth::login($user);

        request()->session()->regenerate();
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
