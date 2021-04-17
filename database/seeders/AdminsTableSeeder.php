<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id'=>1,'name'=>'admin','type'=>'admin', 'mobile'=>'3400000000', 'email'=>'admin@admin.com','password'=>'$2y$10$gwpgcEcrYwaJCFMoqNnNkOSCa/W23gCaBMTpS0of.dZcITIhLinyO','image'=>'','status'=>1
            ],
            [
                'id'=>2,'name'=>'melania','type'=>'admin', 'mobile'=>'3400000000', 'email'=>'melania@admin.com','password'=>'$2y$10$gwpgcEcrYwaJCFMoqNnNkOSCa/W23gCaBMTpS0of.dZcITIhLinyO','image'=>'','status'=>1
            ],
            [
                'id'=>3,'name'=>'pippo','type'=>'subadmin', 'mobile'=>'3400000000', 'email'=>'pippo@admin.com','password'=>'$2y$10$gwpgcEcrYwaJCFMoqNnNkOSCa/W23gCaBMTpS0of.dZcITIhLinyO','image'=>'','status'=>1
            ],
        ];
        foreach($adminRecords as $key => $record){
            \App\Models\Admin::create($record);
        }
    }
}
