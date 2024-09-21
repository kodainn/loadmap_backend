<?php

namespace Database\Seeders;

use App\Models\LoadmapContent;
use App\Models\LoadmapContentResource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LoadmapContentResoucesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loadmapContentIds = LoadmapContent::pluck('id')->all();

        $loadmapContentResources = [];

        foreach ($loadmapContentIds as $loadmapContentId) {
            for ($i = 0; $i < rand(0, 3); $i++) {
                $loadmapContentResources[] = [
                    'loadmap_content_id' => $loadmapContentId,
                    'link_url' => 'url',
                    'title' => Str::random(20)
                ];
            }
        }

        if (!empty($loadmapContentResources)) {
            LoadmapContentResource::insert($loadmapContentResources);
        }
    }
}
