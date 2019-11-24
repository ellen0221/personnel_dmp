<?php

use Illuminate\Database\Seeder;
use \App\Users;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充用户数据 php artisan db:seed --class=UserTableSeeder
        Users::create([
            'staff_id' => 1,
            'username' => "xujing",
            'password' => bcrypt('19980824'),    // 要用Auth验证，新建对象时密码只能用bcrypt加密
        ]);
        \App\Admin::create([
            'staff_id' => 1,
            'username' => "xujing",
            'password' => bcrypt('19980824'),    // 要用Auth验证，新建对象时密码只能用bcrypt加密
        ]);
    }
}
