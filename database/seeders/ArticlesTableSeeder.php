<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();
        $articles = [];
        foreach ($userIds as $userId) {
            for ($i = 0; $i < rand(1, 10); $i++) {
                $year = rand(2023, 2024);
                $month = rand(1, 12);
                $day = rand(1, 28);
                $createdAt = Carbon::create($year, $month, $day)->toDateTimeString();
                $articles[] = [
                    'title' => Str::random(20),
                    'summary' => Str::random(150),
                    'prerequisite_knowledge' => Str::random(150),
                    'creating_user_id' => $userId,
                    'created_at' => $createdAt
                ];
            }
        }

        if (!empty($articles)) {
            Article::insert($articles);
        }
    }
}
