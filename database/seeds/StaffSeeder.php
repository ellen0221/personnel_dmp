<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充职工数据
        \Illuminate\Support\Facades\DB::table('staff_info')->insert([
            ['username' => 'xujing','truename' => '徐静', 'department_id' => 1, 'post_id' => 17, 'is_admin' => 1],
        ]);
    }
}
