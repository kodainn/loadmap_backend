<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebNotice;
use Exception;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PDOException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $this->call([
                UsersTableSeeder::class,
                WebNoticesTableSeeder::class,
                WebNoticeMessagesTableSeeder::class,
                SettingMailNoticesTableSeeder::class,
                FollowUserTableSeeder::class,
                ProfilesTableSeeder::class,
                UserAdsTableSeeder::class,
                ArticlesTableSeeder::class,
                ArticleLikesTableSeeder::class,
                ArticleCommentsTableSeeder::class,
                ArticleViewLogsTableSeeder::class,
                LoadmapContentsTableSeeder::class,
                LoadmapContentResoucesTableSeeder::class,
                TagsTableSeeder::class,
                TagUsersTableSeeder::class,
                ArticleTagTableSeeder::class
            ]);

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
