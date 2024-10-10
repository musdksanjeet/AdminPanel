<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataList;

class DataListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataListRecord = array(
                [
                 'id'   =>1,
                 'field_name' => 'job_title',
                 'list_id'    => 1 ,
                 'value'      => 'PHP Developer', 
                 'status'     => 1,
                 'created_at' => now(),
                 'updated_at' => now(),                
                ],

                [
                 'id'   =>2,
                 'field_name' => 'source_type',
                 'list_id'    => 1 ,
                 'value'      => 'LinkdIn',
                 'status'     => 1,
                 'created_at' => now(),
                 'updated_at' => now(),                  
                ],

                [
                 'id'   =>3,
                 'field_name' => 'job_title',
                 'list_id'    => 2 ,
                 'value'      => 'Content Writer',
                 'status'     => 1,
                 'created_at' => now(),
                 'updated_at' => now(),                  
                ],
            );
        DataList::insert($dataListRecord);
    }
}
