<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password= Hash::make('123456');
        $adminRecords = [
            // ['id'=>1,'name'=>'admin','type'=>'admin','email'=>'admin@gmail.com','mobile'=>1236547890,'password'=>$password,'image'=>'','status'=>1],
            ['id'=>2,'name'=>'Sanjeet','type'=>'subadmin','email'=>'sanjeet@gmail.com','mobile'=>1236547890,'password'=>$password,'image'=>'','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
