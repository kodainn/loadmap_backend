<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\InertiaResponses\HomeResponse;
use App\Models\Article;
use App\Models\User;
use App\Usecases\MarkingTag\FetchMarkingTagAction;
use App\Usecases\RankingArticle\FetchRankingArticleAction;
use App\Usecases\RecommendedArticle\FetchRecommendedArticleAction;
use Illuminate\Auth\AuthManager;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(
        AuthManager                   $auth,
        FetchMarkingTagAction         $fetchMarkingTagAction,
        FetchRecommendedArticleAction $fetchRecommendedArticleAction,
        FetchRankingArticleAction     $fetchRankingArticleAction,
        User                          $user,
        Article                       $article,
        HomeResponse                  $response
    ): Response
    {
        $markingTags = $fetchMarkingTagAction($user, $auth->guard()->id());
        $recommendedArticles = $fetchRecommendedArticleAction($user, $article, $auth->guard()->id());
        $rankingArticles = $fetchRankingArticleAction($article);

        return $response('HomePage', $markingTags, $recommendedArticles, $rankingArticles);
    }
}
