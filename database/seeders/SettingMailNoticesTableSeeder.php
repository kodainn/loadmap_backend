<?php

namespace Database\Seeders;

use App\Models\SettingMailNotice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingMailNoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->all();

        $settingMailNotices = [];
        
        foreach($userIds as $userId) {
            $settingMailNotices[] = [
                'user_id' => $userId
            ];
        }

        if(!empty($settingMailNotices)) {
            SettingMailNotice::insert($settingMailNotices);
        }
    }
}
