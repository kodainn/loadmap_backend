<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleLike;
use App\Models\User;
use Illuminate\Database\Seeder;

use function DeepCopy\deep_copy;

class ArticleLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleIds = Article::pluck('id')->all();
        $userIds = User::pluck('id')->all();
        $articleLikes = [];

        foreach ($articleIds as $articleId) {
            $tmpUserIds = deep_copy($userIds);
            $numLikes = rand(0, 20);
            
            for ($i = 0; $i < $numLikes; $i++) {
                
                $randomNum = rand(0, count($tmpUserIds) - 1);
                $userId = $tmpUserIds[$randomNum];
                
                $articleLikes[] = [
                    'article_id' => $articleId,
                    'liking_user_id' => $userId
                ];

                unset($tmpUserIds[$randomNum]);
                $tmpUserIds = array_values($tmpUserIds);
            }
        }

        if (!empty($articleLikes)) {
            ArticleLike::insert($articleLikes);
        }
    }
}
