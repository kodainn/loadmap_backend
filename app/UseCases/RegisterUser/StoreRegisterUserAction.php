<?php

declare(strict_types=1);

namespace App\Usecases\RegisterUser;

use App\Models\Profile;
use App\Models\SettingMailNotice;
use App\Models\TempUser;
use App\Models\User;
use App\Models\WebNotice;
use App\Usecases\RegisterUser\Exceptions\RegisteredUserException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreRegisterUserAction
{
    public function __invoke(
        Request           $request,
        TempUser          $tempUserModel,
        User              $userModel,
        WebNotice         $webNoticeModel,
        SettingMailNotice $settingMailNoticeModel,
        Profile           $profileModel
    ): void
    {
        $targetTempUser = $tempUserModel->where('token', '=', $request->token)->first()->toArray();

        if(! $targetTempUser) return;
        $isUser = $userModel->where('name', '=', $targetTempUser['name'])->exists();
        if($isUser) {
            throw new RegisteredUserException();
            return;
        }

        $userModel->create($targetTempUser);

        $userId = DB::getPdo()->lastInsertId();

        $webNoticeModel->create(['received_user_id' => $userId]);
        $settingMailNoticeModel->create(['user_id' => $userId]);
        $profileModel->create(['user_id' => $userId]);
    }
}