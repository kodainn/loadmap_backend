<?php

declare(strict_types=1);

namespace App\Usecases\Auth\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("ユーザーが見つかりませんでした。");
    }
}