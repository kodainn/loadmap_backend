<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagIds = Tag::pluck('id')->all();
        $userIds = User::pluck('id')->all();

        $tagUsers = [];
        foreach($tagIds as $tagId) {
            $tagUsers[] = [
                'tag_id' => $tagId,
                'user_id' => $userIds[rand(0, count($userIds) - 1)]
            ];
        }

        if(!empty($tagUsers)) {
            TagUser::insert($tagUsers);
        }
    }
}
