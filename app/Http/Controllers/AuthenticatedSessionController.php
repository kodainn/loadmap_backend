<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\ErrorResponses\ErrorResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PersonalAccessTokenResource;
use App\Models\User;
use App\Usecases\Auth\CreateTokenAction;
use App\Usecases\Auth\Exceptions\UserNotFoundException;
use App\Usecases\Auth\Exceptions\PasswordMismatchException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticatedSessionController extends Controller
{
    public function store(
        LoginRequest      $request,
        CreateTokenAction $action,
        User              $user
    ): JsonResource|JsonResponse
    {
        try {
            $token = $action($request, $user);
            return new PersonalAccessTokenResource($token);
        } catch(UserNotFoundException $e) {
            return ErrorResponse::jsonEncode(404, $e->getMessage());
        } catch(PasswordMismatchException $e) {
            return ErrorResponse::jsonEncode(404, $e->getMessage());
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
