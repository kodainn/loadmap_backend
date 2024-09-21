<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\InertiaResponses\FollowUserArticleResponse;
use App\Models\Article;
use App\Models\FollowUser;
use App\Usecases\FollowUserArticle\FetchFollowUserArticleAction;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Auth\AuthManager;

class FollowUserArticleController extends Controller
{
    public function index(
        AuthManager                  $auth,
        FetchFollowUserArticleAction $action,
        Article                      $article,
        FollowUser                   $followUser,
        FollowUserArticleResponse    $response
    ): Response
    {
        $followArticles = $action($article, $followUser, $auth->guard()->id());
        
        return $response('FollowPage', $followArticles);
    }
}
