<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords= array(
            ['id'=>1,'parent_id'=>0,'category_name'=>'Clothing','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'clothing','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            ['id'=>2,'parent_id'=>0,'category_name'=>'Electronics','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'electronics','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            ['id'=>3,'parent_id'=>0,'category_name'=>'Application','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'application','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            ['id'=>4,'parent_id'=>1,'category_name'=>'Mens','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'mens','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            ['id'=>5,'parent_id'=>1,'category_name'=>'Women','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'women','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            ['id'=>6,'parent_id'=>1,'category_name'=>'Kids','category_image'=>'','category_discount'=>0,'category_description'=>'','category_url'=>'kids','category_meta_title'=>'','category_meta_description'=>'','category_meta_keyword'=>'','category_status'=>1],

            );

        Category::insert($categoryRecords);

    }
}
