<?php

declare(strict_types=1);

namespace App\Usecases\Auth\Exceptions;

use Exception;

class PasswordMismatchException extends Exception
{
    public function __construct()
    {
        parent::__construct("パスワードが違います。");
    }
}