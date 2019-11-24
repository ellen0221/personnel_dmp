<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充部门数据
        \Illuminate\Support\Facades\DB::table('department_info')->insert([
            ['name' => '总裁办', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '行政部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '人事部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '财务部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '技术研发部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '运营部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '广告投放部', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
