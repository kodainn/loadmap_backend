<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleViewLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use function DeepCopy\deep_copy;

class ArticleViewLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleIds = Article::pluck('id')->all();
        $userIds = User::pluck('id')->all();
        $articleViewLogs = [];

        foreach ($articleIds as $articleId) {
            $tmpUserIds = deep_copy($userIds);
            $numViewLogs = rand(0, 20);
            
            for ($i = 0; $i < $numViewLogs; $i++) {
                
                $randomNum = rand(0, count($tmpUserIds) - 1);
                $userId = $tmpUserIds[$randomNum];
                
                $articleViewLogs[] = [
                    'article_id' => $articleId,
                    'view_user_id' => $userId
                ];

                unset($tmpUserIds[$randomNum]);
                $tmpUserIds = array_values($tmpUserIds);
            }
        }

        if (!empty($articleViewLogs)) {
            ArticleViewLog::insert($articleViewLogs);
        }
    }
}
