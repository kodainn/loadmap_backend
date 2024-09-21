<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TempRegisterUser\StoreTempRegisterUserRequest;
use App\Models\TempUser;
use App\Usecases\TempRegisterUser\StoreTempRegisterUserAction;
use Exception;
use Inertia\Inertia;

class TempRegisterUserController extends Controller
{
    public function create()
    {
        return Inertia::render('TempRegisterPage');
    }

    public function store(
        StoreTempRegisterUserRequest $request,
        StoreTempRegisterUserAction  $action,
        TempUser                     $tempUser
    )
    {
        try {
            $action($request, $tempUser);
            return to_route('tempRegister.comp');
        } catch(Exception $e) {
            dd("エラーが発生しました。" . $e);   
        }
    }

    public function comp()
    {
        return Inertia::render('TempRegisterComplatePage');
    }
}
