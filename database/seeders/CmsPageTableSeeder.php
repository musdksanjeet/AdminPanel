<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPages;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $cmspagerecords = [
            ['id'=>1,'title'=>'About Us','url'=>'about-us','meta_title'=>'About Us','meta_description'=>'About Us Meta description','meta_keyword'=>'About Us Meta Keyword','description'=>'Content is coming soon','status'=>1],

            ['id'=>2,'title'=>'Contact Us','url'=>'contact-us','meta_title'=>'Contact Us','meta_description'=>'Contact Us Meta description','meta_keyword'=>'Contact Us Meta Keyword','description'=>'Content is coming soon','status'=>1,],

            ['id'=>3,'title'=>'Terms and Conditions','url'=>'terms-and-conditions','meta_title'=>'Terms and Conditions','meta_description'=>'Terms and Conditions Meta description','meta_keyword'=>'Terms and Conditions Meta Keyword','description'=>'Content is coming soon','status'=>1],
        ];  

        CmsPages::insert($cmspagerecords);  
    }
}
