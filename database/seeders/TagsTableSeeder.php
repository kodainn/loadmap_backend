<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        $tags = [];
        for($i = 0; $i < 100; $i++) {
            $tags[] = [
                'name' => Str::random(10),
                'creating_user_id' => $userIds[rand(0, count($userIds) - 1)]
            ];
        }

        Tag::insert($tags);
    }
}
