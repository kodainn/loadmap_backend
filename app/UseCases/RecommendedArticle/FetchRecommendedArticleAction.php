<?php

declare(strict_types=1);

namespace App\Usecases\RecommendedArticle;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class FetchRecommendedArticleAction
{
    public function __invoke(
        User    $userModel,
        Article $articleModel,
        int     $userId
    ): Collection
    {
        $user = $userModel
            ->where('id', '=', $userId)
            ->with('tags')
            ->first();

        $recommendedArticlesByTag = [];
        foreach($user->tags as $tag) {
            $tag->articles = $articleModel
                ->indexSelect()
                ->orderByRaw("DATE_FORMAT(articles.created_at, '%Y-%m') DESC, likes_count DESC")
                ->join('article_tag', 'articles.id', 'article_tag.article_id')
                ->where('article_tag.tag_id', $tag->id)
                ->offset(0)
                ->limit(5)
                ->get();
            
            if(empty($tag->articles->toArray())) {
                continue;
            }
            
            $recommendedArticlesByTag[] = $tag;
        }
        
        return new Collection($recommendedArticlesByTag);
    }
}