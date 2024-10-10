<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerTableSeeder extends Seeder
{
  
    public function run()
    {
        $BannerRecords= array(
            [
                'image' => 'image1.jpg',
                'type' => 'banner',
                'link' => 'http://example.com/link1',
                'title' => 'First Image Title',
                'alt' => 'First Image Alt Text',
                'sort' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'image2.jpg',
                'type' => 'thumbnail',
                'link' => 'http://example.com/link2',
                'title' => 'Second Image Title',
                'alt' => 'Second Image Alt Text',
                'sort' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'image3.jpg',
                'type' => 'gallery',
                'link' => 'http://example.com/link3',
                'title' => 'Third Image Title',
                'alt' => 'Third Image Alt Text',
                'sort' => 3,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Banner::insert($BannerRecords);
    }
}
