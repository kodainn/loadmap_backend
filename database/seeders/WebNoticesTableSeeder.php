<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebNotice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebNoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        $webNotices = [];
        foreach($userIds as $userId) {
            $webNotices[] = [
                'received_user_id' => $userId
            ];
        }

        if(!empty($webNotices)) {
            WebNotice::insert($webNotices);
        }
    }
}
