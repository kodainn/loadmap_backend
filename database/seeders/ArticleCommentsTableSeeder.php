<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use function DeepCopy\deep_copy;

class ArticleCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleIds = Article::pluck('id')->all();
        $userIds = User::pluck('id')->all();
        $articleComments = [];

        foreach ($articleIds as $articleId) {
            $tmpUserIds = deep_copy($userIds);
            $numComments = rand(0, 20);
            
            for ($i = 0; $i < $numComments; $i++) {
                
                $randomNum = rand(0, count($tmpUserIds) - 1);
                $userId = $tmpUserIds[$randomNum];
                
                $articleComments[] = [
                    'article_id' => $articleId,
                    'commenting_user_id' => $userId,
                    'message' => Str::random(100)
                ];

                unset($tmpUserIds[$randomNum]);
                $tmpUserIds = array_values($tmpUserIds);
            }
        }

        if (!empty($articleComments)) {
            ArticleComment::insert($articleComments);
        }
    }

    
}
