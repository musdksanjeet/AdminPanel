<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecord = array(
            ['id'=>1,'brand_name' => 'Brand One','brand_slug' => 'brand-one','image' => 'brand-one-image.jpg','status'=>1],
            ['id'=>2,'brand_name' => 'Brand Two','brand_slug' => 'brand-two','image' => 'brand-two-image.jpg','status'=>1],
            ['id'=>3,'brand_name' => 'Brand Three','brand_slug' => 'brand-three','image' => 'brand-three-image.jpg','status'=>1],
            ['id'=>4,'brand_name' => 'Brand Four','brand_slug' => 'brand-four','image' => 'brand-four-image.jpg','status'=>1],
            ['id'=>5,'brand_name' => 'Brand Five','brand_slug' => 'brand-five','image' => 'brand-five-image.jpg','status'=>1],
        );

        Brand::insert($brandRecord);
    }
}
