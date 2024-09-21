<?php

namespace Database\Seeders;

use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();
        $reverseUserIds = array_reverse($userIds);

        $followUsers = [];
        for($i = 0; $i < count($userIds); $i++) {
            if($userIds[$i] !== $reverseUserIds[$i]) {
                $followUsers[] = [
                    'followed_user_id' => $userIds[$i],
                    'following_user_id' => $reverseUserIds[$i]
                ];   
            }
        }

        FollowUser::insert($followUsers);
    }
}
