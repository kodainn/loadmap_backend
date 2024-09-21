<?php

declare(strict_types=1);

namespace App\Usecases\RankingArticle;

use App\Models\Article;
use Carbon\Carbon;
use Constants\QueryParamater;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FetchRankingArticleAction
{
    public function __invoke(
        Article $articleModel,
        string  $aggregationMethod = QueryParamater::RANKING_WEEKLY
    ): Collection
    {
        $rankingArticles = [];
        //意図しないパラメータだったらデータを取得しない
        if(! in_array($aggregationMethod, [
            QueryParamater::RANKING_WEEKLY,
            QueryParamater::RANKING_MONTHLY,
            QueryParamater::RANKING_ALL
        ])) {
            return $rankingArticles;
        }

        $baseQuery = $articleModel
            ->indexSelect()
            ->orderByRaw("likes_count DESC")
            ->offset(0)
            ->limit(10);

        $latestArticle = $articleModel->orderBy('created_at', 'desc')->first();
        $latestArticleCreatedAt = Carbon::parse($latestArticle->created_at);

        if($aggregationMethod === QueryParamater::RANKING_WEEKLY) {
            $latestStartWeek = $latestArticleCreatedAt->copy()->startOfWeek()->toDateString();
            $latestEndWeek = $latestArticleCreatedAt->copy()->endOfWeek()->toDateString();
            $rankingArticles = $baseQuery->where([
                    ['articles.created_at', '>=', $latestStartWeek],
                    ['articles.created_at', '<=', $latestEndWeek]
                ])->get();
        }

        if($aggregationMethod === QueryParamater::RANKING_MONTHLY) {
            $latestMonth = $latestArticleCreatedAt->month;
            $rankingArticles = $baseQuery->whereMonth('articles.created_at', $latestMonth)->get();
        }

        if($aggregationMethod === QueryParamater::RANKING_ALL) {
            $rankingArticles = $baseQuery->get();
        }

        return $rankingArticles;
    }
}