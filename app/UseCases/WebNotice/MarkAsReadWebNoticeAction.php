<?php

declare(strict_types=1);

namespace App\Usecases\WebNotice;

use App\Models\WebNotice;
use Carbon\Carbon;

class MarkAsReadWebNoticeAction
{
    public function __invoke(
        WebNotice $webNoticeModel,
        int       $userId
    ): bool
    {
        $lastReadDatetime = Carbon::now()->toDateTimeString();

        return $webNoticeModel
            ->where('received_user_id', $userId)
            ->update([
                    'last_read_datetime' => $lastReadDatetime
            ]);
    }
}