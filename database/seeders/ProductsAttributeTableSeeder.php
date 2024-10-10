<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $attributesRecord= array(
            ['id'=>1,'product_id'=>1,'size'=>'small','SKU'=>'P001','price'=>1000,'stock'=>100,'status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'medium','SKU'=>'P002','price'=>1200,'stock'=>100,'status'=>1],
            ['id'=>3,'product_id'=>3,'size'=>'large','SKU'=>'P003','price'=>1400,'stock'=>100,'status'=>1],
        );

       ProductsAttribute::insert($attributesRecord);
    }
}
