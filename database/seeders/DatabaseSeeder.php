<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(AdminsTableSeeder::class);
        // $this->call(CmsPageTableSeeder::class);
        // $this->call(CategoryTableSeeder::class); 
        // $this->call(ProductTableSeeder::class); 
        // $this->call(BrandTableSeeder::class);
        // $this->call(ProductImageTableSeeder::class); 
        // $this->call(ProductsAttributeTableSeeder::class);
        // $this->call(BannerTableSeeder::class);
         $this->call(DataListTableSeeder::class);  

    }
}
