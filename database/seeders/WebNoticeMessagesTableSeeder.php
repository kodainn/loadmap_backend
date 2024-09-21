<?php

namespace Database\Seeders;

use App\Models\WebNotice;
use App\Models\WebNoticeMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WebNoticeMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webNoticeIds = WebNotice::pluck('id')->all();

        $webNoticeMessages = [];
        foreach($webNoticeIds as $webNoticeId) {
            $webNoticeMessages[] = [
                'web_notice_id' => $webNoticeId,
                'message' => Str::random(100),
                'link_url' => 'url'
            ];
        }

        if(!empty($webNoticeMessages)) {
            WebNoticeMessage::insert($webNoticeMessages);
        }
    }
}
