<?php

declare(strict_types=1);

namespace App\Usecases\TimelineArticle;

use App\Models\WebNotice;
use Illuminate\Database\Eloquent\Model;

class FetchTimelineArticleAction
{
    public function __invoke(
        WebNotice $webNoticeModel,
        int       $userId
    ): Model
    {
        return $webNoticeModel
            ->with('messages')
            ->withCount(['messages as unread_count' => function($query) {
                $query->where('created_at', '>', 'last_read_datetime');
            }])
            ->where('user_id', $userId)
            ->first();
    }
}
