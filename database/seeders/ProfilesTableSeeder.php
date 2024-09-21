<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Table;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        $profiles = [];
        foreach($userIds as $userId) {
            $profiles[] = [
                'user_id' => $userId
            ];
        }

        if(!empty($profiles)) {
            Profile::insert($profiles);
        }
    }
}
