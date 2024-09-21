<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SettingMailNotice;
use App\Models\TempUser;
use App\Models\User;
use App\Models\WebNotice;
use App\Usecases\RegisterUser\Exceptions\RegisteredUserException;
use App\Usecases\RegisterUser\StoreRegisterUserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PDOException;

class RegisterUserController extends Controller
{
    public function store(
        Request                 $request,
        StoreRegisterUserAction $action,
        TempUser                $tempUser,
        User                    $user,
        WebNotice               $webNotice,
        SettingMailNotice       $settingMailNotice,
        Profile                 $profile
    )
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        try {
            DB::beginTransaction();

            $action($request, $tempUser, $user, $webNotice, $settingMailNotice, $profile);

            DB::commit();
            return Inertia::render('RegisterComplatePage');
        } catch(RegisteredUserException $e) {
            DB::rollBack();
            return to_route('home.index');
        } catch(PDOException $e) {
            DB::rollBack();
            return to_route('home.index');
        }
    }
}
