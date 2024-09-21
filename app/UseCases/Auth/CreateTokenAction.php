<?php

declare(strict_types=1);

namespace App\Usecases\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Usecases\Auth\Exceptions\PasswordMismatchException;
use App\Usecases\Auth\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class CreateTokenAction
{
    public function __invoke(
        LoginRequest $request,
        User $user
    ): NewAccessToken
    {
        $user = $user->where('name', '=', $request->name)->first();
        if(empty($user)) {
            throw new UserNotFoundException();
        }

        if(! Hash::check($request->password, $user->password)) {
            throw new PasswordMismatchException();
        }

        $token = $user->createToken('loadmapBackendAPI0513');

        return $token;
    }
}