<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 岗位信息表
        Schema::create('post_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->notnull()->comment('名称');
            $table->string('introduction')->nullable()->comment('简介');
            $table->integer('level')->default(0)->comment('等级');
            $table->integer('department_id')->notnull()->comment('部门id');
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
        Schema::dropIfExists('post_info');
    }
}
