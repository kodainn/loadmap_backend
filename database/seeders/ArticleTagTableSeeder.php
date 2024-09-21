<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagIds = Tag::pluck('id')->all();
        $articleIds = Article::pluck('id')->all();

        $tagArticles = [];
        foreach($articleIds as $articleId) {
            $tagArticles[] = [
                'article_id' => $articleId,
                'tag_id' => $tagIds[rand(0, count($tagIds) - 1)]
            ];
        }

        if(!empty($tagArticles)) {
            ArticleTag::insert($tagArticles);
        }
    }
}
