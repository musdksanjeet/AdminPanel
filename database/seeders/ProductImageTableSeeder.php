<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageRecords = array(
            ['id'=>1,'product_id'=>1,'image'=>'1.jpg','image_sort'=>'1','status'=>1],
            ['id'=>2,'product_id'=>2,'image'=>'2.jpg','image_sort'=>'2','status'=>1],
            ['id'=>3,'product_id'=>3,'image'=>'3.jpg','image_sort'=>'3','status'=>1],
            ['id'=>4,'product_id'=>4,'image'=>'4.jpg','image_sort'=>'4','status'=>1],
            ['id'=>5,'product_id'=>5,'image'=>'5.jpg','image_sort'=>'5','status'=>1],

            );

        ProductImage::insert($imageRecords);
    }
}
