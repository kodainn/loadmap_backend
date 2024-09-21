<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\InertiaResponses\TimelineArticleResponse;
use App\Models\Article;
use App\Usecases\TimelineArticle\FetchTimelineArticleAction;
use Inertia\Inertia;
use Inertia\Response;

class TimelineArticleController extends Controller
{
    public function index(
        FetchTimelineArticleAction $action,
        Article                    $article,
        TimelineArticleResponse    $response
    ): Response
    {
        $timelineArticles = $action($article);
        return $response('TimelinePage', $timelineArticles);
    }
}
