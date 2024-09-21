<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\LoadmapContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LoadmapContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleIds = Article::pluck('id')->all();

        $loadmapContents = [];

        foreach($articleIds as $articleId) {
            for($i = 0; $i < rand(1, 5); $i++) {
                $loadmapContents[] = [
                    'article_id' => $articleId,
                    'title' => Str::random(10),
                    'description' => Str::random(150)
                ];
            }
        }

        if(!empty($loadmapContents)) {
            LoadmapContent::insert($loadmapContents);   
        }
    }
}
