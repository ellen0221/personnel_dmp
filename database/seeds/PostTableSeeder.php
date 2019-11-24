<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充岗位数据
        \Illuminate\Support\Facades\DB::table('post_info')->insert([
            ['name' => '总裁', 'department_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '副总裁', 'department_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '总裁助理', 'department_id' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '行政总监', 'department_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '行政经理', 'department_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '行政前台', 'department_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '行政专员', 'department_id' => 2, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '人力资源总监', 'department_id' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'HR', 'department_id' => 3, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '财务总监', 'department_id' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '财务经理', 'department_id' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '会计师', 'department_id' => 4, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '技术研发部', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '技术总监', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '技术组长', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '前端开发', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '后端开发', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '美术', 'department_id' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '产品运营经理', 'department_id' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '产品运营专员', 'department_id' => 6, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '广告投放经理', 'department_id' => 7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '广告投放专员', 'department_id' => 7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
