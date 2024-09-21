<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\JsonResponses\ErrorResponse;
use App\Models\WebNotice;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use PDOException;

class WebNoticeController extends Controller
{
    public function index(
        WebNotice   $webNotice,
        AuthManager $authManager,
        ErrorResponse $errorResponse
    ): JsonResponse
    {
        try {

        } catch(PDOException $e) {
            return $errorResponse(__('response_message.fail_fetch_data'));
        }
    }
}
