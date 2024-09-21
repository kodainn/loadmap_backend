<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserAdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        $userAds = [];
        foreach($userIds as $userId) {
            for($i = 0; $i <= rand(0, 2); $i++) {
                $userAds[] = [
                    'title' => Str::random(100),
                    'description' => Str::random(500),
                    'creating_user_id' => $userId
                ];
            }
        }

        if(!empty($userAds)) {
            UserAd::insert($userAds);
        }
    }
}
