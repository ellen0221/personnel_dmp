<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 职工信息表
        Schema::create('staff_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->notnull()->comment('部门id');
            $table->integer('post_id')->notnull()->comment('岗位id');
            $table->string('username')->notnull()->unique()->comment('用户名');
            $table->string('truename')->notnull()->comment('真实姓名');
            $table->string('sex')->deafult(1)->comment('性别 1-男 2-女');
            $table->integer('age')->nullable()->comment('年龄');
            $table->string('education')->nullable()->comment('学历');
            $table->integer('is_admin')->default(0)->comment('管理员标志 0-普通职工 1-管理员');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('staff_info');
    }
}
