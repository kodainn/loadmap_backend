<?php

declare(strict_types=1);

namespace App\Usecases\TempRegisterUser;

use App\Http\Requests\TempRegisterUser\StoreRequest;
use App\Http\Requests\TempRegisterUser\StoreTempRegisterUserRequest;
use App\Jobs\SendRegisterUserMailJob;
use App\Models\TempUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreTempRegisterUserAction
{
    public function __invoke(
        StoreTempRegisterUserRequest $request,
        TempUser                     $tempUserModel
    ): void
    {
        $createTempUser = $request->all();
        $createTempUser['token'] = Str::random(64);
        $createTempUser['password'] = Hash::make($request->password);

        $createdTempUser = $tempUserModel->create($createTempUser);
        SendRegisterUserMailJob::dispatch($createdTempUser->email, $createdTempUser->token);
    }
}